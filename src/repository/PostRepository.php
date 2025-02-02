<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';

class PostRepository extends Repository
{
    private function fromAssoc($assoc): Post
    {
        return new Post(
            $assoc['id'],
            $assoc['owner_id'],
            $assoc['topic'],
            $assoc['category_id'],
            $assoc['content'],
            $assoc['datetime']
        );
    }
    public function findById($id)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$post) {
            return null;
        }
        return $this->fromAssoc($post);
    }

    public function create(Post $post)
    {
        $stmt = $this->database->connect()->prepare("INSERT INTO posts (owner_id, category_id, topic, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$post->getOwnerId(), $post->getCategoryId(), $post->getTopic(), $post->getContent()]); // TODO ownerid tu czy w controllerze?
    }

    public function getAll()
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM posts");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];
        foreach ($results as $post) {
            $posts[] = $this->fromAssoc($post);
        }
        return $posts;
    }

    public function findByCategory($category_id)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM posts WHERE category_id = ?");
        $stmt->execute([$category_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];
        foreach ($results as $post) {
            $posts[] = $this->fromAssoc($post);
        }
        return $posts;
    }
}