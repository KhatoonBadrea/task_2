<?php
require_once 'Database.php';
require_once 'Post.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // إنشاء اتصال بقاعدة البيانات
    $db = new Database();

    // جلب المقالة الحالية
    $post = Post::fetchById($db, $id);
}

// إذا لم يتم العثور على المقالة، إعادة التوجيه إلى الصفحة الرئيسية
// if (!$post) {
//     header('Location: showAll.php');
//     exit();
// }
// } else {
//     // إذا لم يتم تمرير ID، إعادة التوجيه إلى الصفحة الرئيسية
//     header('Location: showAll.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // جلب البيانات المعدلة من النموذج

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
    if ((isset($_POST['submit'])) && (empty($errors) == true)) {
        var_dump($title);
        // تعيين البيانات المعدلة
        $post->id = $id;
        $post->title = $title;
        $post->content = $content;
        $post->author = $author;
        var_dump($post);
        // تحديث المقالة في قاعدة البيانات
        if ($post->update($db)) {
            // إعادة التوجيه إلى صفحة عرض جميع المقالات بعد نجاح التعديل
            header('Location: showAll.php');
            exit();
        } else {
            echo "فشل في تعديل المقالة: " . $db->conn->error; // عرض تفاصيل الخطأ
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> edit the post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>edit the post</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post->getTitle()); ?>">
                <?php if (isset($errors['title'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['title']; ?></div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea class="form-control" id="content" name="content" rows="5"><?php echo htmlspecialchars($post->getContent()); ?></textarea>
                <?php if (isset($errors['content'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['content']; ?></div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="author"> author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($post->getAuthor()); ?>">
                <?php if (isset($errors['author'])) { ?>
                    <div class="text-danger mt-2"><?php echo $errors['author']; ?></div>
                <?php } ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">update </button>
        </form>
    </div>
</body>

</html>