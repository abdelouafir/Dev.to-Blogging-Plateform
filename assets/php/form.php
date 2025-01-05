<?php 
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
require_once dirname(__FILE__, 3).'/classes/Article.php';
use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$article = new article();
$category = $article->get_categories($conction);
$tags = $article->get_tags($conction);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auter = 1;
    $title = $_POST['title'];  
    $content = $_POST['content'];  
    $categories = $_POST['categories'];  
    $tags = $_POST['tags'] ?? [];  
    $article->add_article($conction,$title,$content,$categories,$auter);
    $article_id = $article->add_article($conction,$title,$content,$categories,$auter);
    $article->create_tag($conction,$article_id,$tags);
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Articles Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Ajouter un Article</h1>
        
        <form action="./form.php" method="POST">
            <!-- Titre de l'article -->
            <div class="mb-4">
                <label for="title" class="block text-gray-600 mb-2">Titre de l'article</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Entrez le titre de l'article" 
                    required
                />
            </div>
            
            <!-- Contenu de l'article -->
            <div class="mb-4">
                <label for="content" class="block text-gray-600 mb-2">Contenu</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="6" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Écrivez le contenu ici..." 
                    required
                ></textarea>
            </div>

            <!-- Catégories -->
            <div class="mb-4">
                <label for="categories" class="block text-gray-600 mb-2">Catégories</label>
                <select id="categories" name="categories"  class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <?php foreach($category as $cat): ?>
                    <option value="<?php echo $cat['id']?>"><?php echo $cat['name'];?></option>
                    <?php endforeach; ?>    
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-gray-600 mb-2">Tags</label>
                <select id="tags" name="tags[]" multiple class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <?php foreach($tags as $tag): ?>
                    <option value="<?php echo $tag['id']?>"><?php echo $tag['name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Bouton de soumission -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                    Ajouter l'article
                </button>
            </div>
        </form>
    </div>

   
    <script>
    new TomSelect("#tags", {
        maxItems: 10,
        create: false,
        placeholder: 'Select tags...',
    });
   </script>
</body>
</html>

