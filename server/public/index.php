<?php
require_once __DIR__ . '/functions.php';

session_start();

$dbh =  connectDb();

var_dump($_SESSION['id']);

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>


<body>
    <?php include_once __DIR__ . '/_header.html' ?>
    <img src="images/mei.jpg" class="main-photo">
    <img src="" class="sub-photo1">
    <img src="" class="sub-photo2">
    <img src="" class="sub-photo3">
    <img src="" class="sub-photo4">
    <input type="submit" value="好き！" class="like-btn">
    <input type="submit" value="かわいい" class="cute-btn">
</body>

</html>