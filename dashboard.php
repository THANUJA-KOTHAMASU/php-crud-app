<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?=htmlspecialchars($_SESSION['user'])?></h2>
        <div>
            <a href="create.php" class="btn btn-success">+ New Post</a>
            <a href="logout.php" class="btn btn-danger ms-2">Logout</a>
        </div>
    </div>

    <?php foreach ($posts as $post): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?=htmlspecialchars($post['title'])?></h5>
                <p class="card-text"><?=nl2br(htmlspecialchars($post['content']))?></p>
                <p class="text-muted mb-1">By <?=htmlspecialchars($post['username'])?> on <?=date("F j, Y, g:i a", strtotime($post['created_at']))?></p>
                <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
                    <a href="edit.php?id=<?=$post['id']?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?=$post['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
