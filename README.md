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
CREATE TABLE create_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE KEY NOT NULL,
    prefect_id INT(1) 
);


```