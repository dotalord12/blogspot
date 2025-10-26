<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include '../includes/db.php';

$id = $_GET['id'];
$post = $conn->query("SELECT * FROM posts WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $conn->real_escape_string($_POST['title']);
  $content = $conn->real_escape_string($_POST['content']);

  $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
  if ($conn->query($sql)) {
    header("Location: index.php");
  } else {
    $error = "Failed to update post!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
  <div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-blue-400 mb-6">Edit Post</h1>
    <?php if (isset($error)) echo "<p class='text-red-400 mb-3'>$error</p>"; ?>
    <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
      <input type="text" name="title" value="<?php echo $post['title']; ?>" required class="w-full p-3 mb-4 bg-gray-700 rounded">
      <textarea name="content" rows="10" required class="w-full p-3 mb-4 bg-gray-700 rounded"><?php echo $post['content']; ?></textarea>
      <button class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded font-semibold">Update</button>
      <a href="index.php" class="ml-3 text-gray-400 hover:text-white">Cancel</a>
    </form>
  </div>
</body>
</html>
