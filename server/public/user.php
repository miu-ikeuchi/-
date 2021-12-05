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
    a.*,
    c.img,
    d.name as prefecture_name
FROM
    users a
LEFT JOIN
    (SELECT 
         *
    FROM
        likes
    WHERE
        user_id = :id
    ) b
ON
    a.id = b. target_user_id
LEFT JOIN
    sub_images c
ON
    a.id = c.user_id
LEFT JOIN
    prefectures d
ON
    a.prefecture_id = d.id
WHERE
    a.id <> :id
    AND b. target_user_id IS NULL
LIMIT 1
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="user-page">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <img class="user-photo" src="images/<?= $user['img'] ?>">
        <form action="like.php" method="POST">
            <input type="submit" value="好き！" class="userpagelike-btn">
        </form>
        <form action="cute.php" method="POST">
            <input type="submit" value="かわいい" class="userpagecute-btn">
        </form>
    </div>
    <div class="profile">
        <ul>
            <li>ユーザー名<span class="profile-list"><?= $user['name'] ?></span></li>
            <li>居住地<span class="profile-list"><?= $user['prefecture_name'] ?></span></li>
            <li>タイプ<span class="profile-list"><?= get_type_name($user['type']) ?></span></li>
        </ul>
    </div>
</body>

</html>