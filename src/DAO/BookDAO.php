<?php

namespace MyBooks\DAO;

use Doctrine\DBAL\Connection;
use MyBooks\Domain\Book;

class BookDAO
{
    /**
    * Database connection
    *
    * @var \Doctrine\DBAL\Connection
    */
    protected $db;
    
    /**
    * Constructor
    *
    * @param \Doctrine\DBAL\Connection -> The database connection object
    */
    public function __construct(Connection $db) {
        $this->db = $db;
    }
    
    /**
    * Return a list of all books, sorted by date (most recent first)
    * 
    * @return array -> list of books
    */
    public function findAll() {
        $sql = "SELECT * FROM book ORDER BY book_id DESC";
        $result = $this->db->fetchAll($sql);
        
        // Conversion of query into array
        $books = array();
        foreach ($result as $row):
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildBook($row);
        endforeach;
        return $books;
    }
    
    /**
    * Creates a Book object based on a DB row
    *
    * @param array $row -> the db row with the book data
    * @return \MyBooks\Domain\Book
    */
    private function buildBook(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        return $book;
    }
}