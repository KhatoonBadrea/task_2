<?php
require_once 'Database.php';
require_once 'Post.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();

    $post = Post::fetchById($db, $id);

    if (!$post) {
        header('Location: showAll.php');
        exit();
    }
} else {
    header('Location: showAll.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> show the post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>
        <p><strong>author:</strong> <?php echo htmlspecialchars($post->getAuthor()); ?></p>
        <p><strong> created at:</strong> <?php echo htmlspecialchars($post->getCreatedAt()); ?></p>
        <p><?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
        <a href="showAll.php" class="btn btn-secondary"> Back </a>
    </div>
</body>

</html>