
<?php 
require_once 'C:\xampp\htdocs\Dev.to-Blogging-Plateform\vendor\autoload.php';

// require_once 'C:\xampp\htdocs\Dev.to-Blogging-Plateform\confige\db.php';

use Config\Database;
$conn = new Database();



if($_SERVER['REQUEST_METHOD'] == $_POST){
    $tag = $_POST['title'];
    $conn->test = $tag;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Ajouter un tage</h1>
        
        <form action="./tages.php" method="POST">
            <!-- Titre de l'article -->
            <div class="mb-4">
                <label for="title" class="block text-gray-600 mb-2">Titre de tage</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Entrez le titre de l'article" 
                    required
                />
            </div>
        <!-- Bouton de soumission -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                    Ajouter tage
                </button>
            </div>
        </form>
    </div>
</body>
</html>



