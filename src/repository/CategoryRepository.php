<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryRepository extends Repository
{

    public function findAll()
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($categories as $category) {
            $result[] = $this->fromAssoc($category);
        }
        return $result;
    }

    public function findById($id)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$category) {
            return false;
        }
        return $this->fromAssoc($category);
    }

    public function findByName($name)
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM categories WHERE name = ?");
        $stmt->execute([$name]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$category) {
            return false;
        }
        return $this->fromAssoc($category);
    }
    private function fromAssoc($assoc)
    {
        return new Category($assoc['id'], $assoc['name']);
    }
}