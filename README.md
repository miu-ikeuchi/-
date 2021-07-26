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
    prefect_id INT(2),
    address VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type TINYINT(1) NOT NULL,
    id_img VARCHAR(255) NOT NULL,
    cc_img VARCHAR(255) NOT NULL,
    status TINYINT(1),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    request TINYINT(1) NOT NULL,
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
    CONSTRAINT fk_matching_id
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
    prefecture VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

```