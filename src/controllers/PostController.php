<?php
require_once 'AppController.php';

class PostController extends AppController
{
    private $messages = [];

    public function createPost()
    {
        if ($this->isPost()) {

            if (!$this->validatePost()) {
                die('validate post'); // TODO
            }

            return $this->render('main', ['messages' => $this->messages]); //TODO widok posta
        }
        $this->render('create');
    }

    private function validatePost(): bool
    {
        // TODO
        return true;
    }
}