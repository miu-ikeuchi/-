<?php
require_once __DIR__ . '/../common/functions.php';

session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];

$dbh =  connectDb();

$sql = <<<EOM
SELECT 
    *
FROM
    users
WHERE
    name = :name,
    prefecture
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
$sub_images = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <img src="images/mei.jpg" class="user-photo" href="user.php">
        <a href="photo.php" class="photo-plus-btn">Photo</a>
    </div>
    <a href="mypage.php" class="update-btn">更新</a>
    <div class="plofile">
        <ul>
            <li>ユーザー名</li> <input type="text" name="address" value="<?= h($name) ?>">
            <li>居住地</li> <input type="text" name="address" value="<?= h($prefecture_id) ?>">
            <li>
                <label for="type">タイプ
                    <input type="radio" id="human" name="type" value="1">
                    <label for="human">猫探してる</label>
                    <input type="radio" id="cat" name="type" value="2">
                    <label for="cat">里親探してる</label>
                </label>
            </li>
        </ul>
    </div>
</body>

</html>