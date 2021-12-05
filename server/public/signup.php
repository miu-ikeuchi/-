<?php
require_once __DIR__ . '/../common/functions.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $name = filter_input(INPUT_POST, 'name');
    $prefecture_id = filter_input(INPUT_POST, 'prefecture_id');
    $address = filter_input(INPUT_POST, 'address');
    $password = filter_input(INPUT_POST, 'password');
    $type = isset($_POST["type"]) ? $_POST["type"] : 0;
    $cc_img = filter_input(INPUT_POST, 'cc_img');
    $id_img = filter_input(INPUT_POST, 'id_img');

    //バリデーション
    $errors = signup_validate($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img);

    if (empty($errors)) {
        insert_user($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img);

        header('Location: login.php');
        exit;
    }
}
$prefectures = get_prefectures();
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="signup_body">
    <h1>SignUp form</h1>
    <?php if ($errors) : ?>
        <ul class="error-list">
            <?php foreach ($errors as $error) : ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="" method="post">
        <div class="group">
            <label for="name">USERID
                <input type="text" name="name" value="<?= h($name) ?>">
            </label>
        </div>
        <div class="group">
            <label for="prefecture_id">ADDRESS
                <select name="prefecture_id" value="<?= h($prefecture_name) ?>">
                <?php foreach ($prefectures as $prefecture): ?>
                    <option value="<?= $prefecture['id']?>"><?= $prefecture['name'] ?></option>
                <?php endforeach ?>
                </select>
                <input type="text" name="address" value="<?= h($adress) ?>">
            </label>
        </div>
        <div class="group">
            <label for="email">E-MAIL
                <input type="email" name="email" value="<?= h($email) ?>">
            </label>
        </div>
        <div class="group">
            <label for="password">PASSWORD
                <input type="password" name="password">
            </label>
        </div>
        <div class="group">
            <label for="type">TYPE
                <input type="radio" id="human" name="type" value="1">
                <label for="human">猫探してる</label>
                <input type="radio" id="cat" name="type" value="2">
                <label for="cat">里親探してる</label>
            </label>
        </div>
        <div class="group">
            <label for="certificate">CERTIFICATE
                <input type="file" name="cc_img" accept="image/jpg, image/png" value="<?= h($cc_img) ?>">
            </label>
        </div>
        <div class="group">
            <label for="id">IDENTIFICATION
                <input type="file" name="id_img" accept="image/jpg, image/png" value="<?= h($id_img) ?>">
            </label>
        </div>
        <input type="submit" value="新規登録">
    </form>
</body>

</html>