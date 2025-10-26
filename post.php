<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="max-w-3xl mx-auto mt-10">
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
$row = $result->fetch_assoc();
?>
  <h1 class="text-4xl font-bold text-blue-400 mb-4"><?php echo $row['title']; ?></h1>
  <p class="text-gray-400 text-sm mb-6"><?php echo date("F j, Y", strtotime($row['created_at'])); ?></p>
  <p class="text-gray-200 leading-relaxed"><?php echo nl2br($row['content']); ?></p>
</div>

</body>
</html>
