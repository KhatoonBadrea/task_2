<?php
// Post.php
require_once 'PostOperationsTrait.php';

class Post
{
    use PostOperationsTrait;

    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($title, $content, $author, $created_at = null, $updated_at = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
