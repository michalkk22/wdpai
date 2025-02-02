<?php
require_once 'AppController.php';
require_once __DIR__ . '/../repository/PostRepository.php';

class PostController extends AppController
{
    private $messages = [];
    private $postRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = new PostRepository();
    }

    public function createPost()
    {
        if ($this->isPost()) {

            $post = new Post(
                null,
                1, //$_POST['owner_id'], //TODO owner_id tutaj czy w repo?
                $_POST['topic'],
                $_POST['category_id'],
                $_POST['content'],
                null
            );

            if (!$this->validatePost($post)) {
                return $this->render('create', ['messages' => $this->messages]);
            }

            return $this->render('main', ['messages' => $this->messages]); //TODO widok posta
        }
        $this->render('create');
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