<?php
require_once __DIR__ . '/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];
    $img = $_FILES['photo_img'];
    if ($img['name']) {
        move_uploaded_file(
            $img['tmp_name'],
            '/var/www/public/images/' . $img['name']
        );
    }
    insertPhoto($user_id, $img['name']);
    header('Location: mypage.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="photo-plus">
    <?php include_once __DIR__ . '/_header.html' ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="group">
            <label for="id">Photo
                <input type="file" name="photo_img" accept="image/jpg, image/png" value="<?= h($img) ?>">
            </label>
        </div>
        <input type="submit" value="メイン画像登録">
    </form>
</body>

</html>