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
CREATE USER users IDENTIFIED BY "1234";

-- すべての権限を付与
GRANT ALL ON nyapple.* TO users;

-- テーブルの作成
CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL,
    prefecturesecture_id INT,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type TINYINT NOT NULL,
    id_img VARCHAR(255) NOT NULL,
    cc_img VARCHAR(255) NOT NULL,
    status TINYINT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_prefecturesecture_id
        FOREIGN KEY (prefecturesecture_id) 
        REFERENCES prefecturesectures (id)
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
    CONSTRAINT fk_matching_1_id
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
    send_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_matching_2_id
        FOREIGN KEY (matching_id) 
        REFERENCES matchings (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_send_id
        FOREIGN KEY (send_id) 
        REFERENCES users (id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE prefectures(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name CHAR(12) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);
INSERT INTO prefectures(id, name) VALUES(1,'北海道');
INSERT INTO prefectures(id, name) VALUES(2,'青森県');
INSERT INTO prefectures(id, name) VALUES(3,'岩手県');
INSERT INTO prefectures(id, name) VALUES(4,'宮城県');
INSERT INTO prefectures(id, name) VALUES(5,'秋田県');
INSERT INTO prefectures(id, name) VALUES(6,'山形県');
INSERT INTO prefectures(id, name) VALUES(7,'福島県');
INSERT INTO prefectures(id, name) VALUES(8,'茨城県');
INSERT INTO prefectures(id, name) VALUES(9,'栃木県');
INSERT INTO prefectures(id, name) VALUES(10,'群馬県');
INSERT INTO prefectures(id, name) VALUES(11,'埼玉県');
INSERT INTO prefectures(id, name) VALUES(12,'千葉県');
INSERT INTO prefectures(id, name) VALUES(13,'東京都');
INSERT INTO prefectures(id, name) VALUES(14,'神奈川県');
INSERT INTO prefectures(id, name) VALUES(15,'新潟県');
INSERT INTO prefectures(id, name) VALUES(16,'富山県');
INSERT INTO prefectures(id, name) VALUES(17,'石川県');
INSERT INTO prefectures(id, name) VALUES(18,'福井県');
INSERT INTO prefectures(id, name) VALUES(19,'山梨県');
INSERT INTO prefectures(id, name) VALUES(20,'長野県');
INSERT INTO prefectures(id, name) VALUES(21,'岐阜県');
INSERT INTO prefectures(id, name) VALUES(22,'静岡県');
INSERT INTO prefectures(id, name) VALUES(23,'愛知県');
INSERT INTO prefectures(id, name) VALUES(24,'三重県');
INSERT INTO prefectures(id, name) VALUES(25,'滋賀県');
INSERT INTO prefectures(id, name) VALUES(26,'京都府');
INSERT INTO prefectures(id, name) VALUES(27,'大阪府');
INSERT INTO prefectures(id, name) VALUES(28,'兵庫県');
INSERT INTO prefectures(id, name) VALUES(29,'奈良県');
INSERT INTO prefectures(id, name) VALUES(30,'和歌山県');
INSERT INTO prefectures(id, name) VALUES(31,'鳥取県');
INSERT INTO prefectures(id, name) VALUES(32,'島根県');
INSERT INTO prefectures(id, name) VALUES(33,'岡山県');
INSERT INTO prefectures(id, name) VALUES(34,'広島県');
INSERT INTO prefectures(id, name) VALUES(35,'山口県');
INSERT INTO prefectures(id, name) VALUES(36,'徳島県');
INSERT INTO prefectures(id, name) VALUES(37,'香川県');
INSERT INTO prefectures(id, name) VALUES(38,'愛媛県');
INSERT INTO prefectures(id, name) VALUES(39,'高知県');
INSERT INTO prefectures(id, name) VALUES(40,'福岡県');
INSERT INTO prefectures(id, name) VALUES(4,'佐賀県');
INSERT INTO prefectures(id, name) VALUES(42,'長崎県');
INSERT INTO prefectures(id, name) VALUES(43,'熊本県');
INSERT INTO prefectures(id, name) VALUES(44,'大分県');
INSERT INTO prefectures(id, name) VALUES(45,'宮崎県');
INSERT INTO prefectures(id, name) VALUES(46,'鹿児島県');
INSERT INTO prefectures(id, name) VALUES(47,'沖縄県');

```