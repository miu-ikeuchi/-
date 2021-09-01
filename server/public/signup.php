<?php
require_once __DIR__ . '/functions.php';
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
    $errors = signupValidate($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img);

    if (empty($errors)) {
        insertUser($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img);

        header('Location: login.php');
        exit;
    }
}
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
                <select name="prefecture_id" value="<?= h($prefecture_id) ?>">
                    <option value="">都道府県</option>
                    <option value="1">北海道</option>
                    <option value="2">青森県</option>
                    <option value="3">岩手県</option>
                    <option value="4">宮城県</option>
                    <option value="5">秋田県</option>
                    <option value="6">山形県</option>
                    <option value="7">福島県</option>
                    <option value="8">茨城県</option>
                    <option value="9">栃木県</option>
                    <option value="10">群馬県</option>
                    <option value="11">埼玉県</option>
                    <option value="12">千葉県</option>
                    <option value="13">東京都</option>
                    <option value="14">神奈川県</option>
                    <option value="15">新潟県</option>
                    <option value="16">富山県</option>
                    <option value="17">石川県</option>
                    <option value="18">福井県</option>
                    <option value="19">山梨県</option>
                    <option value="20">長野県</option>
                    <option value="21">岐阜県</option>
                    <option value="22">静岡県</option>
                    <option value="23">愛知県</option>
                    <option value="24">三重県</option>
                    <option value="25">滋賀県</option>
                    <option value="26">京都府</option>
                    <option value="27">大阪府</option>
                    <option value="28">兵庫県</option>
                    <option value="29">奈良県</option>
                    <option value="30">和歌山県</option>
                    <option value="31">鳥取県</option>
                    <option value="32">島根県</option>
                    <option value="33">岡山県</option>
                    <option value="34">広島県</option>
                    <option value="35">山口県</option>
                    <option value="36">徳島県</option>
                    <option value="37">香川県</option>
                    <option value="38">愛媛県</option>
                    <option value="39">高知県</option>
                    <option value="40">福岡県</option>
                    <option value="41">佐賀県</option>
                    <option value="42">長崎県</option>
                    <option value="43">熊本県</option>
                    <option value="44">大分県</option>
                    <option value="45">宮崎県</option>
                    <option value="46">鹿児島県</option>
                    <option value="47">沖縄県</option>
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