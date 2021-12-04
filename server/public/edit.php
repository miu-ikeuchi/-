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
    a.name,
    c.name as prefecture_name,
    a.type,
    b.img
FROM
    users a
INNER JOIN
    sub_images b
ON
    a.id = b.user_id
INNER JOIN
    prefectures c
ON
    a.prefecture_id = c.id
WHERE
    a.id = :id
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam('id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$prefectures = get_prefectures();

if (empty($errors)) {
    $sql = <<<EOM
        UPDATE
            users
        SET
            name = :name,
            prefecture_name = :prefecture_name,
            type = :type
        WHERE
            id = :id
        EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam('name', $name, PDO::PARAM_STR);
    $stmt->bindParam('prefecture_name', $prefecture_name, PDO::PARAM_STR);
    $stmt->bindParam('type', $type, PDO::PARAM_STR);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
// テーブルに登録されている内容をフォームで入力した値で上書き
$bt['name'] = $name;
$bt['prefecture_name'] = $prefecture_name;
$bt['type'] = $type;

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="mypage">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <a href="photo.php" class="photo-plus-btn">Photo</a>
    </div>
    <a href="mypage.php" class="update-btn">更新</a>
    <div class="profile">
        <ul>
            <li>ユーザー名</li> <input type="text" name="address" value=" value=" <?= h($bt['name']) ?>>
            <li>居住地</li>
            <select name="prefecture_id" value="<?= h($bt['prefecture_name']) ?>">
                <?php foreach ($prefectures as $prefecture) : ?>
                    <option value=" <?= $prefecture['id'] ?>"><?= $prefecture['name'] ?></option>
                <?php endforeach ?>
            </select>
            <li>
                <label for="type">タイプ
                    <input type="radio" id="human" name="type" value=" <?= h($bt['measurement_date']) ?>>
                    <label for="human">猫</label>
                    <input type="radio" id="cat" name="type" value="2">
                    <label for="cat">里親</label>
                </label>
            </li>
        </ul>
    </div>
</body>

</html>