<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Verify the password
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
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
