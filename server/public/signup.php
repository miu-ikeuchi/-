<?php
require_once __DIR__ . '/functions.php';

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <form action="" method="post" class="">
        <ul class="signup-form">
            <li>ユーザー名<br><input type="text" name="user_name" id="user_name" value=""></li>
            <li>住所:県<br><input type="text" name="prefecture" id="prefecture" value=""></li>
            <li>住所:市町村<br><input type="text" name="adress" id="adress" value=""></li>
            <li>メールアドレス<br></e-mail><input type="text" name="email" id="email" value=""></li>
            <li>パスワード<br><input type="text" name="password" id="password" value=""></li>
            <li>確認用パスワード<br><input type="text" name="con-pass" id="con-pass" value=""></li>
            <li>飼育歴証明書<br><input type="file" name="certificate-up" accept="image/jpeg, image/png"></li>
            <li>身分証明書<br><input type="file" name="id-up" accept="image/jpeg, image/png"></li>
            <li><input type="submit" value="登録"></li>
        </ul>
    </form>
</body>

</html>