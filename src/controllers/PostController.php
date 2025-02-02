<?php
require_once 'AppController.php';
require_once __DIR__ . '/../repository/PostRepository.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';

class PostController extends AppController
{
    private $messages = [];
    private $postRepository;
    private $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = new PostRepository();
        $this->categoryRepository = new CategoryRepository();
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
            //TODO owner_id tutaj czy w repo?
            $post = new Post(
                null,
                1, //$_POST['owner_id'],
                $_POST['topic'],
                $_POST['category'],
                $_POST['content'],
                null
            );

            if (!$this->validatePost($post)) {
                return $this->render('create', ['messages' => $this->messages]);
            }
            $this->postRepository->create($post);

            return $this->main(); //TODO widok posta
        }
        return $this->render('create', ['categories' => $this->categoryRepository->findAll()]);
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
}