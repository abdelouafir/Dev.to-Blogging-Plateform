<?php 
// var_dump(dirname(__FILE__,2));
require_once dirname(__FILE__, 2).'/vendor/autoload.php';
require_once dirname(__FILE__, 2).'/classes/user.php';

use Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
$user_calass = new User();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userNume = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_calass->insert($conction,$userNume,$email,$password);
    header("location: ./login.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Create an Account</h2>
    <form action="./sin-up.php" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          required 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
        />
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          required 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
        />
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          required 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
        />
      </div>        
      <div>
        <button 
          type="submit" 
          class="w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Sign Up
        </button>
      </div>
      <p class="text-sm text-center text-gray-600">
        Already have an account? 
        <a href="#" class="text-indigo-500 hover:underline">Log in</a>
      </p>
    </form>
  </div>
</body>
</html>
