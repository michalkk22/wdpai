<?php
require_once 'AppController.php';
require_once __DIR__ . '/../repository/PostRepository.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';
require_once __DIR__ . '/../repository/CommentRepository.php';

class PostController extends AppController
{
    private $messages = [];
    private $postRepository;
    private $categoryRepository;
    private $commentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = new PostRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->commentRepository = new CommentRepository();
    }

    public function main()
    {
        $posts = $this->postRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $this->render('main', ['posts' => $posts, 'categories' => $categories, 'messages' => $this->messages]);
    }

    public function createPost()
    {
        if ($this->isPost()) {
            $post = new Post(
                null,
                $_SESSION['user_id'],
                $_POST['topic'],
                $_POST['category'],
                $_POST['content'],
                null
            );

            if (!$this->validatePost($post)) {
                return $this->render('create', ['messages' => $this->messages]);
            }
            $postId = $this->postRepository->create($post);

            $url = "http://" . $_SERVER["HTTP_HOST"];
            header("Location: {$url}/post/{$postId}");
        }
        return $this->render('create', ['categories' => $this->categoryRepository->findAll()]);
    }

    public function deletePost()
    {
        if ($this->isPost()) {
            $this->postRepository->deleteById($_POST['post_id']);

            return $this->main();
        }

        $messages[] = 'Bad request';
        return $this->main();
    }

    public function search()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if ($contentType === 'application/json') {
            $content = json_decode(
                trim(file_get_contents('php://input')),
                true
            );

            header('Content-type: application/json');
            http_response_code(200);

            $posts = $this->postRepository->search($content['search']);

            $postsData = array_map(function ($post) {
                return $post->toArray();
            }, $posts);

            echo json_encode($postsData);
        }
    }

    public function categorySearch()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if ($contentType === 'application/json') {
            $content = json_decode(
                trim(file_get_contents('php://input')),
                true
            );

            header('Content-type: application/json');
            http_response_code(200);

            $posts = $this->postRepository->findByCategoryId($content['categoryId']);

            $postsData = array_map(function ($post) {
                return $post->toArray();
            }, $posts);

            echo json_encode($postsData);
        }
    }

    public function post($arg)
    {
        $postId = $arg[0];
        if ($this->isGet()) {
            $post = $this->postRepository->findById($postId);

            return $this->render(
                'post',
                [
                    'post' => $post,
                    'comments' => $this->commentRepository->findByPostId($postId)
                ]
            );
        }
        $messages[] = 'Bad request';
        return $this->main();
    }

    public function createComment()
    {
        if ($this->isPost()) {
            $comment = new Comment(
                null,
                $_SESSION['user_id'],
                null,
                $_POST['post_id'],
                $_POST['text'],
                null
            );

            if ($this->validateComment($comment)) {
                $this->commentRepository->create($comment);
            }

            $post = $this->postRepository->findById($_POST['post_id']);

            return $this->render(
                'post',
                [
                    'post' => $post,
                    'comments' => $this->commentRepository->findByPostId($_POST['post_id'])
                ]
            );
        }

        $messages[] = 'Bad request';
        return $this->main();
    }

    public function deleteComment()
    {
        if ($this->isPost()) {
            $this->commentRepository->deleteById($_POST['comment_id']);

            $post = $this->postRepository->findById($_POST['post_id']);

            return $this->render(
                'post',
                [
                    'post' => $post,
                    'comments' => $this->commentRepository->findByPostId($_POST['post_id'])
                ]
            );
        }

        $messages[] = 'Bad request';
        return $this->main();
    }

    private function validatePost(Post $post): bool
    {
        if ($post->getTopic() === null) {
            $messages[] = 'Invalid topic';
            return false;
        }

        if ($post->getContent() === null) {
            $messages[] = 'Invalid content';
            return false;
        }
        return true;
    }

    private function validateComment(Comment $post): bool
    {
        if ($post->getText() === null) {
            $messages[] = 'Invalid text';
            return false;
        }
        return true;
    }

}