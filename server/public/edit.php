<?php
require_once __DIR__ . '/../common/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];

$dbh = connectDb();

$user = find_user_by_id($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $prefecture_id = filter_input(INPUT_POST, 'prefecture_id');
    $type = isset($_POST["type"]) ? $_POST["type"] : 0;

    //バリデーション
    $errors = update_validate($name, $prefecture_id, $type);
    if (empty($errors)) {
        update_user($id, $name, $prefecture_id, $type);

        header('Location: mypage.php');
        exit;
    }
}
$prefectures = get_prefectures();

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <a href="photo.php" class="photo-plus-btn">Photo</a>
    </div>
    <form method="POST" action="edit.php">
        <input type="submit" class = "update-btn" value="更新">
        <div class="profile">
            <?php if ($errors) : ?>
                <ul class="error-list">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= h($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <ul>
                <li>ユーザー名</li> <input type="text" name="name" value="<?= h($user['name']) ?>">
                <li>居住地</li>
                <select name="prefecture_id">
                    <?php foreach ($prefectures as $prefecture) : ?>
                        <option value="<?= h($prefecture['id']) ?>" <?php if (h($user['prefecture_id']) == h($prefecture['id'])) echo 'selected' ?>><?= h($prefecture['name']) ?></option>
                    <?php endforeach ?>
                </select>
                <li>
                    <label for="type">タイプ
                        <input type="radio" id="human" name="type" value="1" <?php if (h($user['type']) == 1) echo 'checked' ?>>
                        <label for="human">里親</label>
                        <input type="radio" id="cat" name="type" value="2" <?php if (h($user['type']) == 2) echo 'checked' ?>>
                        <label for="cat">猫</label>
                    </label>
                </li>
            </ul>
        </div>
    </form>
</body>

</html>