<?php

namespace MyBooks\Domain;

class Book
{
    /**
    * Book id.
    *
    * @var integer
    */
    protected $id;

    /**
    * Book Title
    *
    * @var string
    */
    protected $title;

    /**
    * Book isbn
    *
    * @var string
    */
    protected $isbn;

    /**
    * Book summary
    *
    * @var string
    */
    protected $summary;

    /**
    * Associated book author
    *
    * @var MyBooks\Domain\Author
    */
    protected $author;

    // GETTERS //

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }    

    public function getIsbn() {
        return $this->isbn;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function getAuthor() {
        return $this->author;
    }

    // SETTERS //

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function setAuthor(Author $author) {
        $this->author = $author;
    }
}