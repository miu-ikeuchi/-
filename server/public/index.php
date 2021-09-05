<?php
require_once __DIR__ . '/functions.php';

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

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>


<body class="main-page">
    <?php include_once __DIR__ . '/_header.html' ?>
    <a href="user.php">
        <!-- <img src="images/mei.jpg" class="main-photo"> -->
        <div class="main-photo"><?= h($photo['img']) ?></div>
    </a>
    <input type="submit" value="好き！" class="like-btn">
    <input type="submit" value="かわいい" class="cute-btn">
</body>

</html>