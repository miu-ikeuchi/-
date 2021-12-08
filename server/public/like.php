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

    insert_likes($id, $target_user_id, REQUEST_LIKE);
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="emo-page">
    好き！を送りました
    <a href="index.php" class="return-btn">メイン画面に戻る</a>
</body>

</html>