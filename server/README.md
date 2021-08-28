-----------------------------
  
  # アプリ名

  ニャップル
  
  ## アプリの概要
  
  保護猫と里親をつなぐマッチングアプリです。

----------------------------- 


```sql
-- データベースの作成
CREATE DATABASE nyapple;

-- ユーザーとパスワードの作成
CREATE USER nyapple_user IDENTIFIED BY "1234";

-- すべての権限を付与
GRANT ALL ON nyapple.* TO nyapple_users;

-- テーブルの作成
CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL,
    prefecture_id INT,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type TINYINT NOT NULL,
    id_img VARCHAR(255) NOT NULL,
    cc_img VARCHAR(255) NOT NULL,
    status TINYINT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_prefecture_id
        FOREIGN KEY (prefecture_id)
        REFERENCES prefecture (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE sub_images(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    img VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_id
        FOREIGN KEY (user_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE like_users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT NOT NULL,
    target_user_id INT NOT NULL,
    request TINYINT NOT NULL,
    matching_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_applicant_id
        FOREIGN KEY (applicant_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_target_id
        FOREIGN KEY (target_user_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_like_users_matching
        FOREIGN KEY (matching_id) 
        REFERENCES matchings (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE matchings(
    id INT PRIMARY KEY AUTO_INCREMENT,
    cat_user_id INT NOT NULL,
    master_user_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_cat_id
        FOREIGN KEY (cat_user_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_master_id
        FOREIGN KEY (master_user_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE messages(
    id INT PRIMARY KEY AUTO_INCREMENT,
    matching_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_message_matching
        FOREIGN KEY (matching_id) 
        REFERENCES matchings (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_message_user_id
        FOREIGN KEY (user_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE prefectures(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name CHAR(12) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);
INSERT INTO prefectures(id, name) VALUES
(1,'北海道'),
(2,'青森県'),
(3,'岩手県'),
(4,'宮城県'),
(5,'秋田県'),
(6,'山形県'),
(7,'福島県'),
(8,'茨城県'),
(9,'栃木県'),
(10,'群馬県'),
(11,'埼玉県'),
(12,'千葉県'),
(13,'東京都'),
(14,'神奈川県'),
(15,'新潟県'),
(16,'富山県'),
(17,'石川県'),
(18,'福井県'),
(19,'山梨県'),
(20,'長野県'),
(21,'岐阜県'),
(22,'静岡県'),
(23,'愛知県'),
(24,'三重県'),
(25,'滋賀県'),
(26,'京都府'),
(27,'大阪府'),
(28,'兵庫県'),
(29,'奈良県'),
(30,'和歌山県'),
(31,'鳥取県'),
(32,'島根県'),
(33,'岡山県'),
(34,'広島県'),
(35,'山口県'),
(36,'徳島県'),
(37,'香川県'),
(38,'愛媛県'),
(39,'高知県'),
(40,'福岡県'),
(41,'佐賀県'),
(42,'長崎県'),
(43,'熊本県'),
(44,'大分県'),
(45,'宮崎県'),
(46,'鹿児島県'),
(47,'沖縄県');

```