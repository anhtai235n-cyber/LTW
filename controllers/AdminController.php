<?php
require_once 'config/database.php';
require_once 'config/Validator.php';
require_once 'config/CsrfToken.php';
require_once 'models/User.php';
require_once 'models/Tour.php';
require_once 'models/Contact.php';
require_once 'models/Setting.php';
require_once 'models/Booking.php';
require_once 'models/News.php';
require_once 'models/NewsComment.php';
require_once 'models/FAQ.php';
require_once 'models/Rating.php';

class AdminController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index()
    {
        $userModel = new User($this->db);
        $newsModel = new News($this->db);
        $commentModel = new NewsComment($this->db);

        $stmtUsers = $userModel->readAll();
        $allUsers = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

        $stmtNews = $newsModel->readAll();
        $recent_news = $stmtNews->fetchAll(PDO::FETCH_ASSOC);

        $stmtComments = $commentModel->readAll();
        $recent_comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

        $tourModel = new Tour($this->db);
        $stmtTours = $tourModel->readAll();
        $allTours = $stmtTours->fetchAll(PDO::FETCH_ASSOC);

        $stats = [
            'total_users' => count($allUsers),
            'total_news' => count($recent_news),
            'pending_comments' => count(array_filter($recent_comments, function ($c) {
                return $c['status'] === 'pending';
            })),
            'total_tours' => count($allTours)
        ];

        $pageTitle = 'Dashboard';
        $contentView = 'views/admin/index.php';
        require_once 'views/admin/layout.php';
    }

    // ===================== QUẢN LÝ TOUR =====================
    public function tours()
    {
        $tourModel = new Tour($this->db);
        $stmt = $tourModel->readAll();
        $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalTours = count($tours);
        $activeTours = 0;
        $hiddenTours = 0;
        foreach ($tours as $t) {
            if (($t['status'] ?? '') == 'active') $activeTours++;
            else $hiddenTours++;
        }

        $pageTitle = "Quản lý Tour";
        $contentView = "views/admin/tours/index.php"; // View này chỉ chứa "phần ruột" bảng danh sách
        require_once 'views/admin/layout.php';
    }

    public function tours_create()
    {
        $pageTitle = "Thêm Tour mới";
        $contentView = "views/admin/tours/create.php"; // View này chứa form "phần ruột"
        require_once 'views/admin/layout.php';
    }

    public function tours_store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tourModel = new Tour($this->db);
            
            $tourModel->tour_code = $_POST['tour_code'];
            $tourModel->name      = $_POST['name'];
            $tourModel->category  = $_POST['category'];
            $tourModel->price     = $_POST['price'];
            $tourModel->duration  = $_POST['duration'];
            $tourModel->location  = $_POST['location'];
            $tourModel->status    = $_POST['status'];
            $tourModel->description = $_POST['description'];
            $tourModel->highlights  = $_POST['highlights'];
            $tourModel->itinerary   = $_POST['itinerary'];
            $tourModel->policy      = $_POST['policy'];

            $tourModel->image_url = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/tours/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $file_name = time() . "_" . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $tourModel->image_url = $file_name; 
                }
            }

            if ($tourModel->create()) {
                if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                    $gallery_dir = "public/uploads/tours/gallery/";
                    if (!file_exists($gallery_dir)) mkdir($gallery_dir, 0777, true);
                    
                    $total = count($_FILES['gallery']['name']);
                    for ($i = 0; $i < $total; $i++) {
                        if ($_FILES['gallery']['error'][$i] == 0) {
                            $g_name = time() . "_" . $_FILES["gallery"]["name"][$i];
                            $g_target = $gallery_dir . $g_name;
                            
                            if (move_uploaded_file($_FILES["gallery"]["tmp_name"][$i], $g_target)) {
                                $tourModel->addImage($g_name, 0); 
                            }
                        }
                    }
                }

                header("Location: index.php?url=admin/tours&success=1");
                exit;
            } else {
                echo "Lỗi khi thêm tour!";
            }
        }
    }

    public function tours_edit()
    {
        if (isset($_GET['id'])) {
            $tourModel = new Tour($this->db);
            $tourModel->id = $_GET['id'];

            if ($tourModel->readOne()) {
                $tour = [
                    'id' => $tourModel->id,
                    'tour_code' => $tourModel->tour_code,
                    'name' => $tourModel->name,
                    'category' => $tourModel->category,
                    'price' => $tourModel->price,
                    'duration' => $tourModel->duration,
                    'location' => $tourModel->location,
                    'status' => $tourModel->status,
                    'image_url' => $tourModel->image_url,
                    'description' => $tourModel->description,
                    'highlights' => $tourModel->highlights,
                    'itinerary' => $tourModel->itinerary,
                    'policy' => $tourModel->policy,
                ];

                $pageTitle = "Cập nhật Tour";
                $contentView = "views/admin/tours/edit.php"; // View này chỉ chứa "phần ruột" form
                require_once 'views/admin/layout.php'; // Nạp khung Dashboard chuẩn
            } else {
                echo "Không tìm thấy tour!";
            }
        }
    }

    public function tours_update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $tourModel = new Tour($this->db);
            
            $tourModel->id = $_POST['id'];
            $tourModel->tour_code = $_POST['tour_code'];
            $tourModel->name = $_POST['name'];
            $tourModel->category = $_POST['category'];
            $tourModel->price = $_POST['price'];
            $tourModel->duration = $_POST['duration'];
            $tourModel->location = $_POST['location'];
            $tourModel->status = $_POST['status'];
            $tourModel->description = $_POST['description'];
            $tourModel->highlights = $_POST['highlights'];
            $tourModel->itinerary = $_POST['itinerary'];
            $tourModel->policy = $_POST['policy'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/tours/"; 
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . "_" . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $tourModel->image_url = $file_name;
                }
            } else {
                $tourModel->image_url = $_POST['old_image'] ?? null;
            }

            if ($tourModel->update()) {
                if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                    $target_dir = "public/uploads/tours/gallery/";
                    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
                    
                    foreach ($_FILES['gallery']['tmp_name'] as $key => $tmp_name) {
                        if ($_FILES['gallery']['error'][$key] == 0) {
                            $file_name = time() . "_" . $_FILES['gallery']['name'][$key];
                            $target_file = $target_dir . $file_name;
                            if (move_uploaded_file($tmp_name, $target_file)) {
                                $tourModel->addImage($file_name, 0);
                            }
                        }
                    }
                }
                header("Location: index.php?url=admin/tours&success=1");
                exit;
            } else {
                echo "Lỗi khi cập nhật tour!";
            }
        }
    }

    public function tours_delete()
    {
        if (isset($_GET['id'])) {
            $tourModel = new Tour($this->db);
            $tourModel->id = $_GET['id'];
            if ($tourModel->delete()) {
                header("Location: index.php?url=admin/tours&deleted=1");
                exit;
            } else {
                echo "Lỗi khi xoá tour!";
            }
        }
    }

    // ===================== QUẢN LÝ LIÊN HỆ =====================
    public function contact()
    {
        $contactModel = new Contact($this->db);
        $stmt = $contactModel->readAll();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalContacts = count($contacts);
        $unreadContacts = 0;
        foreach ($contacts as $c) {
            if ($c['status'] == 'unread')
                $unreadContacts++;
        }

        $pageTitle = "Quản lý Liên hệ";
        $contentView = "views/admin/contact.php";
        require_once 'views/admin/layout.php';
    }

    public function contact_status()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
            $contactModel = new Contact($this->db);
            $contactModel->id = $_POST['id'];
            $contactModel->status = $_POST['status'];

            if ($contactModel->updateStatus()) {
                header("Location: /admin/contact");
                exit;
            } else {
                echo "Lỗi cập nhật trạng thái liên hệ!";
            }
        }
    }

    public function contact_delete()
    {
        if (isset($_GET['id'])) {
            $contactModel = new Contact($this->db);
            $contactModel->id = $_GET['id'];

            if ($contactModel->delete()) {
                header("Location: /admin/contact");
                exit;
            } else {
                echo "Lỗi khi xoá liên hệ!";
            }
        }
    }

    // ===================== CÀI ĐẶT CHUNG =====================
    public function setting()
    {
        $settingModel = new Setting($this->db);
        $settings = $settingModel->getAll();

        $pageTitle = "Cài đặt Chung";
        $contentView = "views/admin/setting.php";
        require_once 'views/admin/layout.php';
    }

    public function setting_update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $settingModel = new Setting($this->db);
            $settings_data = [
                'site_name' => $_POST['site_name'],
                'hero_title' => $_POST['hero_title'],
                'company_phone' => $_POST['company_phone'],
                'company_email' => $_POST['company_email'],
                'company_address' => $_POST['company_address']
            ];

            // Handle hero image upload separately if provided
            if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["hero_image"]["name"]);
                if (move_uploaded_file($_FILES["hero_image"]["tmp_name"], $target_file)) {
                    $settings_data['hero_image'] = $target_file;
                }
            }

            if ($settingModel->updateMultiple($settings_data)) {
                // Pass success flag to view
                $_SESSION['setting_success'] = "Cập nhật cấu hình thành công!";
            } else {
                $_SESSION['setting_error'] = "Đã có lỗi xảy ra khi cập nhật!";
            }

            header("Location: /admin/setting");
            exit;
        }
    }

    // ===================== QUẢN LÝ ĐẶT TOUR =====================
    public function bookings()
    {
        $bookingModel = new Booking($this->db);
        $stmt = $bookingModel->readAll();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý Đặt Tour";
        $contentView = "views/admin/bookings/index.php";
        require_once 'views/admin/layout.php';
    }

    public function booking_status()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
            $bookingModel = new Booking($this->db);
            $bookingModel->id = $_POST['id'];
            $bookingModel->status = $_POST['status'];

            if ($bookingModel->updateStatus()) {
                header("Location: /admin/bookings");
                exit;
            } else {
                echo "Lỗi cập nhật trạng thái đơn đặt tour!";
            }
        }
    }
    // ===================== QUẢN LÝ NGƯỜI DÙNG =====================
    public function users()
    {
        $userModel = new User($this->db);
        $stmtUsers = $userModel->readAll();
        $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý Người dùng";
        $contentView = "views/admin/users/index.php";
        require_once 'views/admin/layout.php';
    }

    // Hiển thị form tạo admin mới
    public function users_create()
    {
        $pageTitle = "Tạo Admin mới";
        $contentView = "views/admin/users/create.php";
        require_once 'views/admin/layout.php';
    }

    // Xử lý lưu admin mới
    public function users_store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate input
            Validator::reset();
            Validator::username($_POST['username'] ?? '');
            Validator::email($_POST['email'] ?? '');
            Validator::password($_POST['password'] ?? '');
            Validator::required($_POST['fullname'] ?? '', 'Họ và tên');
            Validator::passwordMatch($_POST['password'] ?? '', $_POST['confirm_password'] ?? '', 'Mật khẩu');

            if (Validator::fails()) {
                $error = implode(', ', Validator::getErrors());
                $pageTitle = "Tạo Admin mới";
                $contentView = "views/admin/users/create.php";
                require_once 'views/admin/layout.php';
                return;
            }

            $userModel = new User($this->db);
            $userModel->username = Validator::sanitize($_POST['username']);
            $userModel->password = $_POST['password'];
            $userModel->fullname = Validator::sanitize($_POST['fullname']);
            $userModel->email = Validator::sanitize($_POST['email']);

            if ($userModel->createAdmin()) {
                $_SESSION['success'] = "Tạo tài khoản admin thành công!";
                header("Location: /admin/users");
                exit;
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                $pageTitle = "Tạo Admin mới";
                $contentView = "views/admin/users/create.php";
                require_once 'views/admin/layout.php';
            }
        }
    }

    // Nâng cấp user thành admin
    public function users_promote()
    {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];

            if ($userModel->promoteToAdmin()) {
                $_SESSION['success'] = "Nâng cấp thành admin thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Hạ admin xuống member
    public function users_demote()
    {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];

            if ($userModel->demoteToMember()) {
                $_SESSION['success'] = "Hạ xuống member thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Khóa user
    public function users_ban()
    {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];

            if ($userModel->ban()) {
                $_SESSION['success'] = "Khóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Mở khóa user
    public function users_unban()
    {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];

            if ($userModel->unban()) {
                $_SESSION['success'] = "Mở khóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Xóa user
    public function users_delete()
    {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];

            if ($userModel->delete()) {
                $_SESSION['success'] = "Xóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }


    // ===================== QUẢN LÝ FAQ =====================
    public function faqs()
    {
        $faqModel = new FAQ($this->db);
        $stmtFaqs = $faqModel->readAll();
        $faqs = $stmtFaqs->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý FAQ";
        $contentView = "views/admin/faqs/index.php";
        require_once 'views/admin/layout.php';
    }

    // ===================== QUẢN LÝ TIN TỨC=====================
    public function news()
    {
        $newsModel = new News($this->db);
        $search = $_GET['search'] ?? '';

        $query = "SELECT n.*, u.fullname as author_name FROM news n 
                LEFT JOIN users u ON n.author_id = u.id";

        if (!empty($search)) {
            $query .= " WHERE n.title LIKE :search OR n.content LIKE :search";
        }

        $query .= " ORDER BY n.created_at DESC";

        $stmt = $this->db->prepare($query);

        if (!empty($search)) {
            $searchTerm = "%{$search}%";
            $stmt->bindParam(':search', $searchTerm);
        }

        $stmt->execute();
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý Tin tức";
        $contentView = "views/admin/news/index.php";
        require_once 'views/admin/layout.php';
    }
    public function news_create()
    {
        $pageTitle = "Tạo Bài Viết Mới";
        $contentView = "views/admin/news/create.php";
        require_once 'views/admin/layout.php';
    }

    public function news_store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: index.php?url=admin/news");
            exit;
        }

        $newsModel = new News($this->db);
        $newsModel->title = $_POST['title'] ?? '';
        $newsModel->slug = isset($_POST['slug']) && !empty($_POST['slug']) ? $_POST['slug'] : $this->generateSlug($_POST['title']);
        $newsModel->content = $_POST['content'] ?? '';
        $newsModel->description = $_POST['description'] ?? '';
        $newsModel->keywords = $_POST['keywords'] ?? '';
        $newsModel->author_id = $_SESSION['user_id'] ?? 1;
        $newsModel->status = $_POST['status'] ?? 'draft';

        // Xử lý upload ảnh
        $newsModel->image_url = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/news/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = basename($_FILES["image"]["name"]);
            $file_name = time() . '_' . $file_name;
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $newsModel->image_url = $target_file;
            }
        }

        if ($newsModel->create()) {
            header("Location: index.php?url=admin/news&msg=Tạo bài viết thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/news/create&error=Lỗi khi tạo bài viết");
            exit;
        }
    }

    public function news_edit()
    {
        if (!isset($_GET['id'])) {
            header("Location: /admin/news");
            exit;
        }

        $newsModel = new News($this->db);
        $newsModel->id = $_GET['id'];

        if ($newsModel->readById()) {
            $news = [
                'id' => $newsModel->id,
                'title' => $newsModel->title,
                'slug' => $newsModel->slug,
                'content' => $newsModel->content,
                'description' => $newsModel->description,
                'keywords' => $newsModel->keywords,
                'image_url' => $newsModel->image_url,
                'status' => $newsModel->status,
            ];

            $pageTitle = "Sửa Bài Viết";
            $contentView = "views/admin/news/edit.php";
            require_once 'views/admin/layout.php';
        } else {
            header("Location: index.php?url=admin/news&error=Bài viết không tồn tại");
            exit;
        }
    }

    public function news_update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['id'])) {
            header("Location: /admin/news");
            exit;
        }

        $newsModel = new News($this->db);
        $newsModel->id = $_POST['id'];
        $newsModel->title = $_POST['title'] ?? '';
        $newsModel->slug = isset($_POST['slug']) && !empty($_POST['slug']) ? $_POST['slug'] : $this->generateSlug($_POST['title']);
        $newsModel->content = $_POST['content'] ?? '';
        $newsModel->description = $_POST['description'] ?? '';
        $newsModel->keywords = $_POST['keywords'] ?? '';
        $newsModel->status = $_POST['status'] ?? 'draft';

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/news/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = basename($_FILES["image"]["name"]);
            $file_name = time() . '_' . $file_name;
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $newsModel->image_url = $target_file;
            }
        } else {
            $newsModel->image_url = null;
        }

        if ($newsModel->update()) {
            header("Location: index.php?url=admin/news&msg=Cập nhật bài viết thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/news/edit&id=" . $_POST['id'] . "&error=Lỗi khi cập nhật");
            exit;
        }
    }

    public function news_delete()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['news_id'])) {
            header("Location: /admin/news");
            exit;
        }

        $newsModel = new News($this->db);
        $newsModel->id = $_POST['news_id'];

        if ($newsModel->delete()) {
            header("Location: index.php?url=admin/news&msg=Xoá bài viết thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/news&error=Lỗi khi xoá bài viết");
            exit;
        }
    }

    // ===================== DUYỆT BÌNH LUẬN =====================
    public function comments()
    {
        $commentModel = new NewsComment($this->db);
        $stmtComments = $commentModel->readAll();
        $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Duyệt Bình luận";
        $contentView = "views/admin/comments/index.php";
        require_once 'views/admin/layout.php';
    }

    public function comments_approve()
    {
        if (!isset($_POST['comment_id'])) {
            header("Location: /admin/comments");
            exit;
        }

        $commentModel = new NewsComment($this->db);
        $commentModel->id = $_POST['comment_id'];

        if ($commentModel->approve()) {
            header("Location: index.php?url=admin/comments&msg=Duyệt bình luận thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/comments&error=Lỗi khi duyệt");
            exit;
        }
    }

    public function comments_reject()
    {
        if (!isset($_POST['comment_id'])) {
            header("Location: /admin/comments");
            exit;
        }

        $commentModel = new NewsComment($this->db);
        $commentModel->id = $_POST['comment_id'];

        if ($commentModel->reject()) {
            header("Location: index.php?url=admin/comments&msg=Từ chối bình luận thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/comments&error=Lỗi khi từ chối");
            exit;
        }
    }

    public function comments_delete()
    {
        if (!isset($_POST['comment_id'])) {
            header("Location: /admin/comments");
            exit;
        }

        $commentModel = new NewsComment($this->db);
        $commentModel->id = $_POST['comment_id'];

        if ($commentModel->delete()) {
            header("Location: index.php?url=admin/comments&msg=Xoá bình luận thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/comments&error=Lỗi khi xoá");
            exit;
        }
    }

    // ===================== QUẢN LÝ FAQ =====================
    public function faqs_create()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: index.php?url=admin/faqs");
            exit;
        }

        $faqModel = new FAQ($this->db);
        $faqModel->question = $_POST['question'] ?? '';
        $faqModel->answer = $_POST['answer'] ?? '';
        $faqModel->category = $_POST['category'] ?? '';
        $faqModel->order_by = $_POST['ordering'] ?? 0;

        if ($faqModel->create()) {
            header("Location: index.php?url=admin/faqs&msg=Tạo FAQ thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/faqs&error=Lỗi khi tạo FAQ");
            exit;
        }
    }

    public function faqs_update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: index.php?url=admin/faqs");
            exit;
        }

        $faqModel = new FAQ($this->db);
        $faqModel->id = $_POST['faq_id'] ?? 0;
        $faqModel->question = $_POST['question'] ?? '';
        $faqModel->answer = $_POST['answer'] ?? '';
        $faqModel->category = $_POST['category'] ?? '';
        $faqModel->order_by = $_POST['ordering'] ?? 0;

        if ($faqModel->update()) {
            header("Location: index.php?url=admin/faqs&msg=Cập nhật FAQ thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/faqs&error=Lỗi khi cập nhật FAQ");
            exit;
        }
    }

    public function faqs_delete()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: index.php?url=admin/faqs");
            exit;
        }

        $faqModel = new FAQ($this->db);
        $faqModel->id = $_POST['faq_id'] ?? 0;

        if ($faqModel->delete()) {
            header("Location: index.php?url=admin/faqs&msg=Xóa FAQ thành công");
            exit;
        } else {
            header("Location: index.php?url=admin/faqs&error=Lỗi khi xóa FAQ");
            exit;
        }
    }

    // ===================== QUẢN LÝ ĐÁNH GIÁ =====================
    public function ratings()
    {
        $ratingModel = new Rating($this->db);
        $stmtRatings = $ratingModel->readAll();
        $ratings = $stmtRatings->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý Đánh giá";
        $contentView = "views/admin/ratings/index.php";
        require_once 'views/admin/layout.php';
    }

    // ===================== HELPER FUNCTION =====================
    private function generateSlug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
}
?>