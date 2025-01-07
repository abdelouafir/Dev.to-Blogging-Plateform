<?php 
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
require_once dirname(__FILE__, 3).'/classes/Article.php';
use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$article = new article();
$articles = $article->ajoute_article($conction);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer_id'])) {
    $id = $_POST['supprimer_id'];
    if ($article->suprmre_article($conction, $id)) {
        header("Location: ./table-artickles.php");
        exit;
    } else {
        echo "ERORE";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-700 text-center">Gestion des Articles</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-200 text-gray-600 text-sm uppercase font-medium">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Titre</th>
                        <th class="py-3 px-6 text-left">Catégorie</th>
                        <th class="py-3 px-6 text-left">Auteur</th>
                        <th class="py-3 px-6 text-center">Vues</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <!-- Article 1 -->
                     <?php foreach($articles as $article){?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6"><?=$article['id'] ?></td>
                        <td class="py-3 px-6"><?=$article['title'] ?></td>
                        <td class="py-3 px-6"><?=$article['category_name']?></td>
                        <td class="py-3 px-6"><?=$article['username']?></td>
                        <td class="py-3 px-6 text-center">150</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center space-x-4">
                                <form action="/ruturn/updet_article.php" method="POST">
                                    <input type="hidden" name="update_id" value="<?php echo $article['id']; ?>">
                                    <button class=" text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-circle-check" style="color: #1662e3;"></i>
                                    </button>
                                </form>
                                <form action="./table-artickles.php" method="POST">
                                    <input type="hidden" name="supprimer_id" value="<?php echo $article['id']; ?>">
                                    <button class="text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                    <i class="fa-solid fa-user-minus" style="color: #ff0000;"></i>
                                     </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
