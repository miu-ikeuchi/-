<?php
require_once __DIR__ . '/../common/functions.php';
require_once __DIR__ . '/../common/config.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_user_id = filter_input(INPUT_POST, 'target_user_id');

    insert_likes($id, $target_user_id, REQUEST_CUTE);
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="like_page">
    かわいいを送りました
    <a href="index.php">メイン画面に戻る</a>
</body>

</html>