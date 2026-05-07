<?php
require_once 'config/database.php';
require_once 'models/News.php';
require_once 'models/NewsComment.php';

class NewsController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $newsModel = new News($this->db);
        
        // Kiểm tra có tìm kiếm không
        if(isset($_GET['search'])) {
            $keyword = $_GET['search'];
            $stmt = $newsModel->search($keyword);
        } else {
            $stmt = $newsModel->readAll();
        }
        
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Tin Tức";
        require_once 'views/news/index.php';
    }

    public function detail() {
        if(!isset($_GET['slug'])) {
            header("Location: ?url=news");
            exit;
        }

        $newsModel = new News($this->db);
        $newsModel->slug = $_GET['slug'];
        
        if($newsModel->readBySlug()) {
            $article = [
                'id' => $newsModel->id,
                'title' => $newsModel->title,
                'slug' => $newsModel->slug,
                'content' => $newsModel->content,
                'description' => $newsModel->description,
                'keywords' => $newsModel->keywords,
                'image_url' => $newsModel->image_url,
                'author_name' => $newsModel->author_name,
                'views' => $newsModel->views,
                'created_at' => $newsModel->created_at
            ];

            // Lấy bình luận
            $commentModel = new NewsComment($this->db);
            $commentModel->news_id = $newsModel->id;
            $stmtComments = $commentModel->getByNewsId();
            $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

            $pageTitle = $newsModel->title;
            require_once 'views/news/detail.php';
        } else {
            echo "404 - Không tìm thấy bài viết";
        }
    }

    public function submitComment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_SESSION['user_id'])) {
                header("Location: ?url=login");
                exit;
            }

            $commentModel = new NewsComment($this->db);
            $commentModel->news_id = $_POST['news_id'];
            $commentModel->user_id = $_SESSION['user_id'];
            $commentModel->content = $_POST['content'];

            if($commentModel->create()) {
                $_SESSION['comment_success'] = "Bình luận của bạn đã được gửi và chờ duyệt.";
            } else {
                $_SESSION['comment_error'] = "Lỗi khi gửi bình luận.";
            }

            header("Location: ?url=news/" . $_POST['slug']);
            exit;
        }
    }
}
?>
