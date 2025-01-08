<?php 
class User {
    public function insert($pdo, $username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password_hash) 
                VALUES (:username, :email, :password_hash)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $passwordHash);
    
        if ($stmt->execute()) {
            echo 'User added successfully.';
        } else {
            echo 'Failed to add user.';
        }
    }
    
    public function get_all_users ($pdo){
        $sql = "SELECT id,username,role,email,password_hash FROM users";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

    public function login($pdo, $email, $password) {
        $sql = "SELECT * FROM USERS WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                echo "corcted";
                session_start();
                $_SESSION['user'] =  $user;
                header('Location: ../vew/articles-page.php');
            } else {
                echo "no corected";
                echo $user['password_hash'];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found'
            ];
        }
    }

    public function update_role_user($pdo, $id) {
        $role = 'author';
        $sql = "UPDATE users 
                SET role = :role
                WHERE id = :id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        try {
            return $stmt->execute(); 
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage()); 
            return false;
        }
    }

    public function delete_user($pdo, $id) {
        $sql = "DELETE FROM users WHERE id = :id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage());
            return false;
        }
    }
    
}
?>