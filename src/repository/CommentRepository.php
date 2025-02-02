<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Comment.php';

class CommentRepository extends Repository
{
    private $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function findByPostId($post_id)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM comments WHERE post_id = ?");
        $stmt->execute([$post_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($comments as $comment) {
            $result[] = $this->fromAssoc($comment);
        }
        return $result;
    }

    public function create(Comment $comment)
    {
        $stmt = $this->database->connect()->prepare("INSERT INTO comments (author_id, post_id, text) VALUES (?, ?, ?)");
        $stmt->execute([$comment->getAuthorId(), $comment->getPostId(), $comment->getText()]);
    }

    private function fromAssoc($assoc)
    {
        $author = $this->userRepository->findById($assoc['author_id']);
        return new Comment(
            $assoc['id'],
            $assoc['author_id'],
            $author->getEmail(),
            $assoc['post_id'],
            $assoc['text'],
            $assoc['datetime']
        );
    }
}