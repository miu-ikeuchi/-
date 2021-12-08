<?php

define('DSN', 'mysql:host=db;dbname=nyapple;chsrset=utf8');
define('USER', 'nyapple_user');
define('PASSWORD', '1234');

define('MSG_EMAIL_REQUIRED', 'メールアドレスが未入力です');
define('MSG_NAME_REQUIRED', 'ユーザー名が未入力です');
define('MSG_ADDRESS_REQUIRED', '住所が未入力です');
define('MSG_PASSWORD_REQUIRED', 'パスワードが未入力です');
define('MSG_PREFECTURE_REQUIRED', '都道府県が未選択です');
define('MSG_TYPE_REQUIRED', 'TYPEが未選択です');
define('MSG_CC_REQUIRED', '証明書の画像ファイルが未選択です');
define('MSG_ID_REQUIRED', '身分証明書の画像ファイルが未選択です');
define('MSG_NAME_PASSWORD_NOT_MATCH', 'ユーザーIDかパスワードが間違っています');

define('REQUEST_LIKE', 1);
define('REQUEST_CUTE', 2);