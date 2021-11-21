<?php

require_once __DIR__ . '/config.php';

function connectDb()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
function signupValidate($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img)
{
    $errors = [];

    // バリデーション
    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }
    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }
    if (empty($address)) {
        $errors[] = MSG_ADDRESS_REQUIRED;
    }
    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }
    if (empty($prefecture_id)) {
        $errors[] = MSG_PREFECTURE_REQUIRED;
    }
    if (empty($type)) {
        $errors[] = MSG_TYPE_REQUIRED;
    }
    if (empty($cc_img)) {
        $errors[] = MSG_CC_REQUIRED;
    }
    if (empty($id_img)) {
        $errors[] = MSG_ID_REQUIRED;
    }
    return $errors;
}
function insertUser($email, $name, $address, $password, $prefecture_id, $type, $cc_img, $id_img)
{
    $dbh = connectDb();

    $sql = <<<EOM
    INSERT INTO
        users
        (email, name, address, password, prefecture_id, type, cc_img, id_img)
    VALUES
        (:email, :name, :address, :password, :prefecture_id, :type, :cc_img, :id_img)
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':prefecture_id', $prefecture_id, PDO::PARAM_INT);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':cc_img', $cc_img, PDO::PARAM_STR);
    $stmt->bindParam(':id_img', $id_img, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    // パスワードのハッシュ化
    $pw_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $pw_hash, PDO::PARAM_STR);

    $stmt->execute();
}
function loginValidate($name, $password)
{
    $errors = [];

    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }
    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }
    return $errors;
}

function findUserByName($name)
{
    $dbh = connectDb();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        name = :name;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::PARAM_STR);
}
function insertPhoto($user_id, $img)
{
    $dbh = connectDb();

    $sql = <<<EOM
    INSERT INTO
        sub_images
        (user_id, img)
    VALUES
        (:user_id, :img)
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':img', $img, PDO::PARAM_STR);

    $stmt->execute();
}

function get_prefectures()
{

}