<?php

class Post
{
    private ?int $id;
    private $owner_id;
    private $topic;
    private $category_id;
    private $content;
    private $datetime;

    public function __construct(?int $id, int $owner_id, string $topic, int $category_id, string $content, string $datetime)
    {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->topic = $topic;
        $this->category_id = $category_id;
        $this->content = $content;
        $this->datetime = $datetime;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getOwnerId()
    {
        return $this->owner_id;
    }
    public function getTopic()
    {
        return $this->topic;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
}