<?php
require_once __DIR__ . '/../common/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$dbh =  connectDb();

$sql = <<<EOM
SELECT TOP
    (1) *
FROM
    sub_images
ORDER BY
    NEWID()
EOM;

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


<body class="main-page">
    <?php include_once __DIR__ . '/_header.html' ?>
    <a href="user.php">

        <div>
            <!-- <img class="main-photo" src="images/samplecat.jpeg"> -->
            <img class="user-photo" src="images/<?= $sub_images['img'] ?>">
        </div>
    </a>
    <form action="like.php" method="POST">
        <input type="submit" value="好き！" class="like-btn">
    </form>
    <form action="cute.php" method="POST">
        <input type="submit" value="かわいい" class="cute-btn">
    </form>
</body>

</html>