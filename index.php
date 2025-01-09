<?php
require_once dirname(__FILE__, 1).'/vendor/autoload.php';
require_once dirname(__FILE__, 1).'/classes/Article.php';
require_once dirname(__FILE__, 1).'/classes/User.php';
require_once dirname(__FILE__, 1).'/classes/category.php';
require_once dirname(__FILE__, 1).'/classes/DynamicCrud.php';




use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$article = new article();
$users_updt = new User();
$categorys = new category();
$tags = new DynamicCrud();

$toutal_article = $article->toutal_articcle($conction);
$toutal_users = $users_updt->total_users($conction);
$toutal_categorys = $categorys->total_categorys($conction);
$toutal_tags = $tags->totale_tags($conction);

 ?>

<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/aa20b7623e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
    <header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto  w-full z-20 top-0">

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
                        <a class="inline-block py-2 px-4 text-white no-underline" href="./assets/php/form.php">ajouté artickles</a>
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


<main>

    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center" style="width: 280px; margin:0px">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <!-- <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                                <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Tasks</span>
                            </a>
                        </li> -->
                        <li class="mr-3 flex-1">
                            <a href="./vew/articles-page.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                            <i class="fa-solid fa-house-chimney md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">articles</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./includes/mangment_users.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fas fa-chart-area pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">mangement users</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./includes/management_artickles.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fa-solid fa-list-check pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">mangement artic</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./assets/php/tags.php" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fa-sharp fa-solid fa-tag md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">tags</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./assets/php/category_vew.php" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fa-duotone fa-regular fa-icons md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">category</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </nav>
        <section class="w-full">



                <body class="bg-gray-100 text-gray-800">
                    <div class="container mx-auto p-4">
                        <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">Statistiques</h1>

                        <!-- Statistiques générales -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <!-- Card article -->
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold text-gray-700">articles</h2>
                                <p class="text-3xl font-bold text-blue-500 mt-4"><?php echo $toutal_article ?></p>
                            </div>
                            <!-- Card Utilisateurs -->
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold text-gray-700">Utilisateurs</h2>
                                <p class="text-3xl font-bold text-green-500 mt-4"><?php echo $toutal_users ?></p>
                            </div>
                            <!-- Card Catégories -->
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold text-gray-700">Catégories</h2>
                                <p class="text-3xl font-bold text-purple-500 mt-4"><?php echo $toutal_categorys ?></p>
                            </div>
                            <!-- Card Tags -->
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold text-gray-700">Tags</h2>
                                <p class="text-3xl font-bold text-red-500 mt-4"><?php echo $toutal_tags ?></p>
                            </div>
                        </div>

                        <!-- Tableau des données -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Détails des données</h2>
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Nom</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">article </td>
                                        <td class="border border-gray-300 px-4 py-2">article</td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $toutal_article  ?></td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="/assets/php/table-artickles.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">voir détailles</a>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">Utilisateur</td>
                                        <td class="border border-gray-300 px-4 py-2">Utilisateur</td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $toutal_users ?></td>    
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="/assets/php/table.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">voir détailles</a>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">Catégorie </td>
                                        <td class="border border-gray-300 px-4 py-2">Catégorie</td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $toutal_categorys ?></td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="/assets/php/category_vew.php" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">voir détailles</a>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">tags </td>
                                        <td class="border border-gray-300 px-4 py-2">tags</td>
                                        <td class="border border-gray-300 px-4 py-2"><?php echo $toutal_tags ?></td>
                                        <td class="border border-gray-300 px-4 py-2">
                                             <a href="/assets/php/tags.php" class="bg-blue-300 text-white px-4 py-2 rounded hover:bg-blue-400">voir détailles</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </body>


        </section>
    </div>
</main>

      
    </body>
</html>

