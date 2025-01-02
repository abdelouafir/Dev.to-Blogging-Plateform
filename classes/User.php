<?php 
namespace App;
class User {
    private $name ;
    private $email;
    private $password;
    private $role;
    private $conn;
    
    public function __construct($conction)
    {
        $this->conn = $conction;
    }
    
}
?>