<?php 
namespace App;

class Article {
    public $auter;
    public $title;
    public $content;
    private $conn;
    public function __construct($conction)
    {
        $this->conn = $conction;
    }
    
}
?>