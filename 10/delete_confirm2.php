<?php
//セッションの開始
session_start();
if (!((isset($_SESSION['login']) && $_SESSION['login'] == 'OK'))) {
    header('Location: login.html');
    //終了
    exit();
}
require_once(__DIR__ . '/functions.php');
if(isset($_SESSION['delete'])){
    //DBへの接続
    $dbh = connectDB();
    if ($dbh) {
        $sth = $dbh->query($_SESSION['delete']); //SQLの実行
        unset($_SESSION['delete']);
    }
}
header('Location: delete_message.php');
?>