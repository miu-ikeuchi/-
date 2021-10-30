<?php
require_once __DIR__ . '/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];

$dbh =  connectDb();

$sql = <<<EOM
SELECT 
    *
FROM
    sub_images
WHERE
    user_id = :id
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
$sub_images = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <img class="user-photo" src="images/<?= $sub_images['img'] ?>">
        <a href=" photo.php" class="photo-plus-btn">Photo</a>
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