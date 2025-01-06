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

    // public function add_article($pdo, $title, $content, $category_id, $author_id) {
    
    //     $sql = "INSERT INTO articles (title, content, category_id, author_id, views)
    //             VALUES (:title, :content, :category_id, :author_id, :views)";
    //     $stmt = $pdo->prepare($sql);
        
    //     $stmt->bindParam(':title', $title);
    //     $stmt->bindParam(':content', $content);
    //     $stmt->bindParam(':category_id', $category_id);
    //     $stmt->bindParam(':author_id', $author_id);
    //     $stmt->bindValue(':views', 0); 
        
    
    //     if ($stmt->execute()) {
    //         echo "article add";
    //     } else {
    //         echo "errore";
    //     }
    // }

    public function add_article($pdo, $title, $content, $category_id, $author_id) {
        $sql = "INSERT INTO articles (title, content, category_id, author_id, views)
                VALUES (:title, :content, :category_id, :author_id, :views)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindValue(':views', 0); 
        
        if ($stmt->execute()) {
            $lastInsertedId = $pdo->lastInsertId();
            return $lastInsertedId; 
        } else {
            echo "Error occurred while adding article.";
            return null; 
        }
    }
    
    public function create_tag($pdo,$article_id,$tag_id){
         $sql = "INSERT INTO article_tags (article_id,tag_id)
         VALUES (:article_id, :tag_id)";
         $stmt = $pdo->prepare($sql);
         foreach ($tag_id as $tag_id) {
            $stmt->bindParam(':article_id', $article_id);
            $stmt->bindParam(':tag_id', $tag_id);
    
            if (!$stmt->execute()) {
                echo "Error occurred while adding tag ID: " . $tag_id;
                return false; 
            }
        }
        return true;
    }

    public function ajoute_article($pdo) {
        $sql = "SELECT 
           articles.title,
           articles.content,
           users.username,
           categories.name AS category_name
        FROM articles
        JOIN users ON users.id = articles.author_id
        JOIN categories ON categories.id = articles.category_id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
}

?>