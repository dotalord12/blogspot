<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="max-w-5xl mx-auto mt-10 flex justify-start">
  <!-- Left side card -->
  <div class="bg-gray-800 p-6 rounded-lg shadow-md w-64">
    <h1 class="text-xl font-bold text-blue-400 mb-4">Manage Posts</h1>
    <a href="create.php" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white font-semibold block text-center">
      + New Post
    </a>
  </div>
</div>

<!-- Table of posts -->
<div class="max-w-5xl mx-auto mt-6">
  <table class="w-full bg-gray-800 rounded-lg overflow-hidden">
    <tr class="bg-gray-700 text-left">
      <th class="p-3">Title</th>
      <th class="p-3">Date</th>
      <th class="p-3 text-right">Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
    ?>
      <tr class="border-b border-gray-700">
        <td class="p-3"><?php echo $row['title']; ?></td>
        <td class="p-3 text-gray-400"><?php echo date("F j, Y", strtotime($row['created_at'])); ?></td>
        <td class="p-3 text-right">
          <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-400">Edit</a> |
          <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-400" onclick="return confirm('Delete this post?');">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>


</body>
</html>
