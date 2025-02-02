<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';

class PostRepository extends Repository
{
    private $categoryRepository;
    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
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
        $category = $this->categoryRepository->findByName($post->getCategory());
        if (!$category) {
            throw new Exception('No such category', 1);
        }
        $stmt->execute([$post->getOwnerId(), $category->getId(), $post->getTopic(), $post->getContent()]); // TODO ownerid tu czy w controllerze?
    }

    public function findAll()
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM posts ORDER BY datetime DESC");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($posts as $post) {
            $result[] = $this->fromAssoc($post);
        }
        return $result;
    }

    public function findByCategoryId(string $category_id)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM posts WHERE category_id = ?");
        $stmt->execute([$category_id]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($posts as $post) {
            $result[] = $this->fromAssoc($post);
        }
        return $result;
    }

    public function findByCategory(string $category)
    {
        $stmt = $this->database->connect()->prepare(
            "SELECT posts.* FROM posts
                    LEFT JOIN categories ON posts.category_id = categories.id
                    WHERE categories.name = ?"
        );
        $stmt->execute([$category]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($posts as $post) {
            $result[] = $this->fromAssoc($post);
        }
        return $result;
    }

    public function search(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('SELECT * FROM posts WHERE LOWER(topic) LIKE ? OR lower(content) LIKE ?');
        $stmt->execute([$searchString, $searchString]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($posts as $post) {
            $result[] = $this->fromAssoc($post);
        }
        return $result;
    }

    private function fromAssoc($assoc): Post
    {
        $category = $this->categoryRepository->findById($assoc['category_id']);
        return new Post(
            $assoc['id'],
            $assoc['owner_id'],
            $assoc['topic'],
            $category->getName(),
            $assoc['content'],
            $assoc['datetime']
        );
    }
}