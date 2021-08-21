<?php
require_once __DIR__ . '/functions.php';

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="login_page">
        <div class="logo_box"><img src="images/nyapple_logo.png" class="logo"></div>
        <form action="" method="post" class="loginform">
            <ul>
                <li><input type="text" name="user_id" id="user_id" value=""></li>
                <li><input type="text" name="password" id="password" value=""></li>
                <li><input type="submit" value="ログイン"></li>
                <li><a href="signup.php">新規登録</a></li>
            </ul>
        </form>
    </div>
</body>

</html>