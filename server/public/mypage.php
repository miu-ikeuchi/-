<?php
require_once __DIR__ . '/functions.php';

$dbh =  connectDb();

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <div class="user-photo">
            <?php ?>
        </div>
        <a href="photo.php" class="photo-plus-btn">Photo</a>
    </div>
    <a href="edit.php" class="edit-btn">編集</a>
    <div class="plofile">
        <ul>
            <li>ユーザー名</li>
            <li>居住地</li>
            <li>タイプ</li>
            <li>コメント</li>
        </ul>
    </div>
</body>

</html>