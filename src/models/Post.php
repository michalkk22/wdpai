<?php

class Post
{
    private ?int $id;
    private $owner_id;
    private $topic;
    private $category;
    private $content;
    private ?string $datetime;

    public function __construct(?int $id, int $owner_id, string $topic, string $category, string $content, ?string $datetime)
    {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->topic = $topic;
        $this->category = $category;
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
    public function getCategory()
    {
        return $this->category;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'owner_id' => $this->owner_id,
            'topic' => $this->topic,
            'category' => $this->category,
            'content' => $this->content,
            'datetime' => $this->datetime,
        ];
    }
}