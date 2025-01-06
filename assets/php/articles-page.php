<?php 
// namespace app\article;
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
require_once dirname(__FILE__, 3).'/classes/Article.php';
use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$article = new article();


$articles = $article->ajoute_article($conction);
// var_dump($articles);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <a href="#" aria-label="Home">
                    <span class="text-xl pl-2"><i class="em em-grinning"></i></span>
                </a>
            </div>

            <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                    <input aria-label="search" type="search" id="search" placeholder="Search" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </span>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="#">Active</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="/assets/php/form.php">ajouté artickles</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-gray-400 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">link</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, User <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                                <div class="border border-gray-800"></div>
                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</header>

<div class="container mx-auto p-6  grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-1/2 ">
    <!-- Article 1 -->
    <?php foreach($articles as $article) {?>
    <div class="flex items-center mt-20	">
            <div class="flex-shrink-0 h-10 w-10">
                
                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            </div>

            <div class="ml-4">
                <div class="text-sm leading-5 font-medium text-gray-900"><?= $article['username'];?></div>
                <!-- <div class="text-sm leading-5 text-gray-500">john@example.com</div> -->
            </div>
        </div>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    
        <!-- <img class="w-full h-48 object-cover" src="https://via.placeholder.com/300x200" alt="Article Image"> -->
        <div class="p-4 ">
            <h3 class="text-xl font-bold text-gray-800"><?=$article['title']?></h3>
            <p class="text-gray-600 mt-2"><?=$article['content']?></p>
            <div class="mt-4">
                <span class="inline-block bg-blue-500 text-white text-xs font-semibold py-1 px-2 rounded-full mr-2"><?=$article['category_name']?></span>
                <span class="inline-block bg-green-500 text-white text-xs font-semibold py-1 px-2 rounded-full">Actualité</span>
            </div>
        </div>
    </div>
    <?php }?>
</div>
</body>
</html>

</body>
</html>
