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
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');

    $errors = loginValidate($name, $password);

    if (empty($errors)) {
        $user = findUserByName($name);

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = MSG_NAME_PASSWORD_NOT_MATCH;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="login_body">
    <?php if ($errors) : ?>
        <ul class="error-list">
            <?php foreach ($errors as $error) : ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="login_page">
        <div class="logo_box"><img src="images/nyapple_logo.png" class="logo"></div>
        <div class="form-wrapper">
            <h1>Login</h1>
            <form action="" method="post">
                <div class="form-item">
                    <label for="name"></label>
                    <input type="name" name="name" required="required" placeholder="UserID" id="name" value="<?= h($name) ?>"></input>
                </div>
                <div class="form-item">
                    <label for="password"></label>
                    <input type="password" name="password" required="required" placeholder="Password" id="password"></input>
                </div>
                <div class="button-panel">
                    <input type="submit" class="button" title="login" value="ログイン"></input>
                </div>
            </form>
            <div class="form-footer">
                <p><a href="signup.php">Create an account</a></p>
                <p><a href="#">Forgot password?</a></p>
            </div>
        </div>
    </div>
</body>

</html>