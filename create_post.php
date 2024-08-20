<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Database.php';
require_once 'Post.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim(htmlspecialchars($_POST['title']));
    $content = trim(htmlspecialchars($_POST['content']));
    $author = trim(htmlspecialchars($_POST['author']));
    $errors = [];

    if (empty($title)) {
        $errors['title'] = "* Please enter the title";
    }
    if (empty($content)) {
        $errors['content'] = "* Please enter the content";
    }
    if (empty($author)) {
        $errors['author'] = "* Please enter the author";
    }
    // var_dump($title);
    if ((isset($_POST['submit'])) && (empty($errors) == true)) {
        try {
            $db = new Database();
            // var_dump($db);

            $post = new Post($title, $content, $author);
            // var_dump($post);

            if ($post->create($db)) {
                header('Location: showAll.php');
                exit();
            } else {
                echo "<p style='color: red;'>Failed to create the post.</p>";
            }

            $db->closeConnection();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> creat new post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2> create new post</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="title"> title</label>
                <input type="text" class="form-control" id="title" name="title">
                <?php if (isset($errors['title'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['title']; ?></div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="content"> content</label>
                <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                <?php if (isset($errors['content'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['content']; ?></div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="author">author</label>
                <input type="text" class="form-control" id="author" name="author">
                <?php if (isset($errors['author'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['author']; ?></div>
                <?php } ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">save </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>