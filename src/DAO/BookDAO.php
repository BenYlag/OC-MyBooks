<?php

namespace MyBooks\DAO;

use Doctrine\DBAL\Connection;
use MyBooks\Domain\Book;

class BookDAO extends DAO
{
    
    /**
    * Return a list of all books, sorted by date (most recent first)
    * 
    * @return array -> list of books
    */
    public function findAll() {
        $sql = "SELECT book_id, book_title, book_isbn, book_summary, auth_first_name, auth_last_name FROM book LEFT JOIN author on book.auth_id = author.auth_id ORDER BY book_id DESC";
        $result = $this->getDb()->fetchAll($sql);
        
        // Conversion of query into array
        $books = array();
        foreach ($result as $row):
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        endforeach;
        return $books;
    }
    
    /**
    *
    *
    *
    */
    public function findOne($id) {
        $sql = "SELECT book_id, book_title, book_isbn, book_summary, auth_first_name, auth_last_name FROM book LEFT JOIN author on book.auth_id = author.auth_id WHERE book_id=?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));
        
        //Conversion of result into object
        if ($result) {
            return $this->buildDomainObject($result);
        }
        else {
             throw new \Exception("No book matching id " . $id);
        }
    }
    
    /**
    * Creates a Book object based on a DB row
    *
    * @param array $row -> the db row with the book data
    * @return \MyBooks\Domain\Book
    */
    protected function buildDomainObject($row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        $book->setAuthor($row['auth_first_name'] . ' ' . $row['auth_last_name']);
        return $book;
    }
    
    
}