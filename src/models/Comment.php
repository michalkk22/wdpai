<?php

class Comment
{
    private $id;
    private $author_id;
    private $post_id;
    private $text;
    private $datetime;

    public function __construct($id, $author_id, $post_id, $text, $datetime)
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->post_id = $post_id;
        $this->text = $text;
        $this->datetime = $datetime;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getAuthorId(): int
    {
        return $this->author_id;

    }
    public function getPostId(): int
    {
        return $this->post_id;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getDatetime(): string
    {
        return $this->datetime;
    }

}
