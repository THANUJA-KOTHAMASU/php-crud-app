<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$db   = 'blog';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $pass, $options);

// Fetch all posts with author names
$stmt = $pdo->query("
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.created_at DESC
");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>All Posts</h2>
    <p>Welcome, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong> | <a href="logout.php">Logout</a></p>
    <a href="create.php" class="btn btn-primary mb-3">Create New Post</a>

    <?php foreach ($posts as $post): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><?= htmlspecialchars($post['title']) ?></h5>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <small class="text-muted">By <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></small><br>
                <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
                    <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
