<?php

class Comment
{
    private ?int $id;
    private ?int $author_id;
    private ?string $author;
    private $post_id;
    private $text;
    private ?string $datetime;

    public function __construct(?int $id, ?int $author_id, ?string $author, int $post_id, string $text, ?string $datetime)
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->author = $author;
        $this->post_id = $post_id;
        $this->text = $text;
        $this->datetime = $datetime;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthorId()
    {
        return $this->author_id;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getPostId()
    {
        return $this->post_id;
    }
    public function getText()
    {
        return $this->text;
    }
    public function getDatetime()
    {
        return $this->datetime;
    }

}
