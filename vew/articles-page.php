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

session_start();
 $data = $_SESSION['user'] ;


 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de destination avec barre latérale</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col p-6">
    <div class="text-3xl font-semibold mb-10">MonSite</div>
    <?php if (isset($_SESSION['user'])) { ?>
        <nav class="flex-1">
            <ul class="space-y-6">
                <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Accueil</a></li>
                <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Articles</a></li>
                <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">À propos</a></li>
                <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Contact</a></li>
                <li><a href="./logout.php" class="bg-red-600 text-white py-2 px-6 rounded-full shadow-lg hover:bg-red-700 transition">quité</a></li>
                <li><a href="../assets/php/form.php?id=<?php echo $_SESSION['user']['id']; ?>" class="bg-green-600 text-white py-2 px-6 rounded-full shadow-lg hover:bg-red-700 transition">create article</a></li>

            </ul>
        </nav>
    <?php } else { ?>
        <ul class="space-y-6">
            <li><a href="#" class="block text-lg text-gray-400 hover:text-white transition">Accueil</a></li>
            <li><a href="login.php" class="bg-yellow-400 text-gray-900 py-2 px-6 rounded-full shadow-lg hover:bg-yellow-500 transition">Se connecter</a></li>
            <li><a href="./sin-up.php" class="bg-green-600 text-white py-2 px-6 rounded-full shadow-lg hover:bg-green-700 transition">S'inscrire</a></li>
        </ul>
    <?php } ?>
</aside>


    <!-- Contenu principal -->
    <main class="flex-1 bg-white">
      <!-- Section Hero -->
      <section class="relative bg-blue-800 text-white py-24 px-10">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative z-10 container mx-auto text-center">
          <h1 class="text-5xl font-semibold mb-4">
            Bonjour 
            <?php if (isset($_SESSION['user'])): ?>
                <?= $_SESSION['user']['username'] ?>
            <?php else: ?>
                Visiteur
            <?php endif; ?>
          </h1>
          <p class="text-xl mb-6">Plongez dans notre contenu exclusif et enrichissant.</p>
        </div>
      </section>

      <!-- Section Articles -->
      <section id="articles" class="py-16 px-10">
        <div class="container mx-auto">
          <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Nos Derniers Articles</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Carte d'article -->
            <?php foreach($articles_active as $article): ?>
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x250" alt="Article" class="w-full h-56 object-cover">
                <div class="p-6">
                  <h3 class="text-xl font-semibold text-gray-800 mb-4"><?= $article['title'] ?></h3>
                  <p class="text-gray-600 mb-4"><?= $article['content'] ?></p>
                  <p class="text-gray-500 mb-4">Par: <?= $article['username'] ?></p>
                  <a href="#" class="text-blue-600 hover:underline">Lire plus &rarr;</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
    
  </div>

</body>
</html>


