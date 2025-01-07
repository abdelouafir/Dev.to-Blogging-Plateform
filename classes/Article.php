<?php 

class article{

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
           articles.id,
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
    public function suprmre_article($connection, $id) {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update_article($pdo, $id, $title, $content, $category_id) {
        $sql = "UPDATE articles 
                SET title = :title, content = :content, category_id = :category_id 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    
        if ($stmt->execute()) {
            return true; 
        } else {
            echo "Une erreur est survenue lors de la mise à jour de l'article.";
            return false; 
        }
    }

    public function getarticle($pdo,$id){
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    
    }
    
    public function delete_old_tags($pdo,$id){
        $stmt = $pdo->prepare("DELETE FROM article_tags WHERE article_id  = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    public function get_les_articles_active($pdo) {
        $sql = "SELECT 
                   articles.id,
                   articles.title,
                   articles.content,
                   users.username,
                   categories.name AS category_name
                FROM articles
                JOIN users ON users.id = articles.author_id
                JOIN categories ON categories.id = articles.category_id
                WHERE articles.status = 'active';"; 
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>