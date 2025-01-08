<?php 
// namespace app\article;
require_once dirname(__FILE__, 2).'/vendor/autoload.php';
require_once dirname(__FILE__, 2).'/classes/Article.php';
use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$article = new article();
$articles = $article->ajoute_article($conction);
$articles_active =  $article->get_les_articles_active($conction);
// var_dump($articles);
session_start();
// var_dump($_SESSION['user']);
var_dump($_SESSION['user']['username']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page avec Sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col p-6">
      <div class="text-3xl font-semibold mb-10">MonSite</div>
      <nav class="flex-1">
        <ul class="space-y-6">
          <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Accueil</a></li>
          <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Articles</a></li>
          <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">À propos</a></li>
          <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Contact</a></li>
        </ul>
      </nav>
      <footer class="mt-auto text-center text-gray-400 text-sm">
        &copy; 2025 MonSite
      </footer>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-white">
      <!-- Hero Section -->
      <section class="relative bg-blue-800 text-white py-24 px-10">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative z-10 container mx-auto text-center">
          <h1 class="text-5xl font-semibold mb-4">bonjour mr <?php echo $_SESSION['user']['username']; ?> </h1>
          <p class="text-xl mb-6">Plongez dans notre contenu exclusif et enrichissant.</p>
          <a href="../assets/php/form.php" class="bg-yellow-400 text-gray-900 py-2 px-6 rounded-full shadow-lg hover:bg-yellow-500 transition">ajoute article</a>
        </div>
      </section>

      <!-- Articles Section -->
      <section id="articles" class="py-16 px-10">
        <div class="container mx-auto">
          <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Nos Derniers Articles</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Article Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
              <img src="https://via.placeholder.com/400x250" alt="Article 1" class="w-full h-56 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Titre de l'Article</h3>
                <p class="text-gray-600 mb-4">Une introduction captivante de l'article. Curieux d'en savoir plus ?</p>
                <a href="#" class="text-blue-600 hover:underline">Lire plus &rarr;</a>
              </div>
            </div>
            <!-- Répéter pour plus d'articles -->
          </div>
        </div>
      </section>
    </main>
    
  </div>

</body>
</html>



