<?php

require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id');

// データベースに接続
$dbh = connectDb();

$sql = <<<EOM
SELECT
    *
FROM
    users
WHERE
    id = :id
EOM;

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$bt = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body class="user-page">
    <?php include_once __DIR__ . '/_header.html' ?>
    <div class="photo-block">
        <img class="user-photo" src="images/samplecat.jpeg">
        <input type="submit" value="好き！" class="userpagelike-btn">
        <input type="submit" value="かわいい" class="userpagecute-btn">
    </div>
    <div class="plofile">
        <ul>
            <li>ユーザー名</li>
            <li>居住地</li>
            <li>タイプ</li>
            <li>コメント</li>
        </ul>
    </div>
</body>

</html>