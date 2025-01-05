<?php 

class article{
    private $category = [];
    private $tags = [];


    public function get_categories($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM categories");
        $stmt->execute();  
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function get_tags($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM tags");
        $stmt->execute();  
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

?>