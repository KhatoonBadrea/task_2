<?php
require_once 'Database.php';
require_once 'Post.php';

// إنشاء اتصال بقاعدة البيانات
$db = new Database();

// جلب جميع المقالات
$posts = Post::fetchAll($db);
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show the posts </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .text-ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>all posts </h2>
        <a href="create_post.php" class="btn btn-primary">add </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>the title</th>
                    <th>the content</th>
                    <th>the author</th>
                    <th> created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($post->getTitle()); ?></td>
                        <td class="text-ellipsis"><?php echo htmlspecialchars($post->getContent()); ?></td>
                        <td><?php echo htmlspecialchars($post->getAuthor()); ?></td>
                        <td><?php echo htmlspecialchars($post->getCreatedAt()); ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post->getId(); ?>" class="btn btn-primary">edit</a>
                            <a href="delete_post.php?id=<?php echo $post->getId(); ?>" class="btn btn-danger" onclick="return confirm('are you sure?');">delete</a>
                            <a href="show_one_post.php?id=<?php echo $post->getId(); ?>" class="btn btn-success">show</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>