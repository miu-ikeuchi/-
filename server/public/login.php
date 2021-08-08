<?php
require_once __DIR__ . '/functions.php';

?>

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nyapple</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="login_page">
        <div class="logo_box"><img src="images/nyapple_logo.png" class="logo"></div>
        <form action="" method="post" class="loginform">
            <ul>
                <li><input type="text" name="user_id" id="user_id" value=""></li>
                <li><input type="text" name="password" id="password" value=""></li>
                <li><input type="submit" value="ログイン"></li>
                <li><input type="submit" value="新規登録"></li>
            </ul>
        </form>
    </div>
</body>

</html>