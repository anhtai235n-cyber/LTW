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

            $commentModel = new NewsComment($this->db);
            $commentModel->post_id = $newsModel->id;
            $stmtComments = $commentModel->getByNewsId();
            $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

            $pageTitle = $newsModel->title;
            require_once 'views/news/detail.php';
        } else {
            echo "404 - Không tìm thấy bài viết";
        }
    }

    public function submitComment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $comment = new NewsComment($this->db);
            
            $comment->news_id = $_POST['news_id'] ?? $_POST['post_id'] ?? null;
            $comment->user_id = $_SESSION['user_id'] ?? null;
            $comment->content = $_POST['content'];
            $comment->status = 'pending';

            if ($comment->news_id && $comment->user_id && $comment->create()) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Lỗi: Không nhận được ID bài viết hoặc bạn chưa đăng nhập.";
            }
        }
    }
}
?>
