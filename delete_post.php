<?php
require_once 'Database.php';
require_once 'Post.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // إنشاء اتصال بقاعدة البيانات
    $db = new Database();

    // جلب المقالة الحالية
    $post = Post::fetchById($db, $id);
    var_dump($post);

    if ($post) {
        var_dump($post);
        if ($post->delete($db)) {
            header('Location: showAll.php');
            exit();
        } else {
            echo "فشل في حذف المقالة: " . $db->conn->error;
        }
    } else {
        echo "المقالة غير موجودة.";
    }
} else {
    header('Location: showAll.php');
    exit();
}
