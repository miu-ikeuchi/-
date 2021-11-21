<?php
require_once __DIR__ . '/../common/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];

$dbh =  connectDb();

$sql = <<<EOM
SELECT 
    a.name,
    c.name as prefecture_name,
    a.type,
    b.img
FROM
    users a
INNER JOIN
    sub_images b
ON
    a.id = b.user_id
INNER JOIN
    prefectures c
ON
    a.prefecture_id = c.id
WHERE
    a.id = :id
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <img class="user-photo" src="images/<?= $user['img'] ?>">
        <a href=" photo.php" class="photo-plus-btn">Photo</a>
    </div>
    <a href="edit.php" class="edit-btn">編集</a>
    <div class="profile">
        <ul>
            <li>ユーザー名<span class="profile-list"><?= $user['name'] ?></span></li>
            <li>居住地<span class="profile-list"><?= $user['prefecture_name'] ?></span></li>
            <li>タイプ<span class="profile-list"><?= get_type_name($user['type']) ?></span></li>
        </ul>
    </div>
</body>
</html>