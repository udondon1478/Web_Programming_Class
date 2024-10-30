<?php
//セッションの生成

session_start();
//ログイン確認
if (!((isset($_SESSION['login']) && $_SESSION['login'] == 'OK'))) {
    header('Location: login.html');
    exit();
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
//タイトル/メッセージの取得
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

$dbh = connectDB(); //DBへの接続
if ($dbh) {
    $sql = 'INSERT INTO `message_tb`(`message_title`, `message` , `user_name`) VALUES
    (:message_title, :message, :user_name)';
    $stmt = $dbh->prepare($sql);
    $params = array(':message_title' => $title, ':message' => $message, ':user_name' => $_SESSION['name']);
    $stmt->execute($params);
    //最後に追加したレコードの取得
    $last_id = $dbh->lastInsertId();
    $sql = 'SELECT * FROM `message_tb` WHERE `message_id` = :message_id ORDER BY `message_id` DESC';
    $stmt = $dbh->prepare($sql);
    $params = array(':message_id' => $last_id);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //ヘッダの指定でjsonの動作を安定させる
    header('Content-type: application/json');
    //JSON形式に変換
    $json = json_encode($data);
    //JSON形式のデータを出力
    echo $json;
}