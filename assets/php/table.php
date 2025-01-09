<?php 
// namespace App\table;
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
require_once dirname(__FILE__, 3).'/classes/User.php';
require_once dirname(__FILE__, 3).'/classes/Article.php';

use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$users_updt = new User();
$users = $users_updt->get_all_users($conction);
$article_get = new article();
$articles = $article_get->ajoute_article($conction);

session_start();
$data = $_SESSION['user'] ;
if($data['role'] == 'admin'){
   echo "data exeste";
}else{
   header("location: ../../vew/login.php");
}
// var_dump($users);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer_id'])) {
    $id = $_POST['supprimer_id'];
    if ($users_updt->delete_user($conction, $id)) {
        header("Location: ./table.php");
        exit;
    } 
}if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    if ($users_updt->update_role_user($conction, $id)) {
        echo "Mise à jour réussie.";
        header("Location: ../../includes/mangment_users.php");
        exit;
    } else {
        echo "Échec de la mise à jour.";
    }
} else {
    echo "Requête invalide ou 'update_id' manquant.";
}

?>
<!DOCTYPE html>
<html lang="en">
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
<div class="mt-8 w-full	">
    <h4 class="text-gray-600">Wide Table</h4>
    
    <div class="flex flex-col mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 w-full	">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                    <?php foreach($users as $user){?>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900"><?=$user['username']?></div>
                                        <div class="text-sm leading-5 text-gray-500"><?=$user['email']?></div>
                                    </div>
                                </div>
                            </td>
                            
                          

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"><?=$user['role'] ?></td>

                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <!-- <button class=" text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                        <i class="fa-solid fa-circle-check" style="color: #1662e3;"></i>
                                    </button> -->
                                <div class="flex justify-center space-x-4">
                                    <form action="./table.php" method="POST">
                                        <input type="hidden" name="update_id" value="<?php echo $user['id']; ?>">
                                        <button class=" text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                        <i class="fa-solid fa-circle-check" style="color: #1662e3;"></i>
                                    </button>
                                    </form>
                                    <form action="./table.php" method="POST">
                                        <input type="hidden" name="supprimer_id" value="<?php echo $user['id']; ?>">
                                        <button class="text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                        <i class="fa-solid fa-user-minus" style="color: #ff0000;"></i>
                                        </button>
                                    </form> 
                                </div>
                            </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
