<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $check = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if ($check->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen text-white">
  <form method="POST" class="bg-gray-800 p-8 rounded-lg shadow-md w-80">
    <h2 class="text-2xl font-bold mb-4 text-blue-400 text-center">Admin Login</h2>
    <?php if (isset($error)) echo "<p class='text-red-400 mb-3'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required class="w-full p-2 mb-3 rounded bg-gray-700">
    <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 rounded bg-gray-700">
    <button class="w-full bg-blue-500 hover:bg-blue-600 py-2 rounded font-semibold">Login</button>
  </form>
</body>
</html>
