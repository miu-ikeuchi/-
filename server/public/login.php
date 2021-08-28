<?php
require_once __DIR__ . '/functions.php';

// sessionstartは一番はじめに入れる
session_start();

// 既にログインしている場合
if ($_SESSION['id']) {
    header('Location: index.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $errors = loginValidate($email, $password);

    if (empty($errors)) {
        $user = findUserByEmail($email);

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = MSG_EMAIL_PASSWORD_NOT_MATCH;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <?php if ($errors) : ?>
        <ul class="error-list">
            <?php foreach ($errors as $error) : ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="login_page">
        <div class="logo_box"><img src="images/nyapple_logo.png" class="logo"></div>
        <form action="" method="post" class="loginform">
            <label for="email">メールアドレス:
                <input type="email" name="email" id="email" value="<?= h($email) ?>">
            </label>
            <br>
            <label for="password">パスワード:
                <input type="password" name="password" id="password">
            </label>
            <br>
            <input type="submit" value="ログイン">
        </form>
        <a href="signup.php">新規登録はこちら</a>
    </div>
</body>

</html>