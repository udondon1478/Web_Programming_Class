<?php
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');

//セッションの生成
session_start();
if (!(isset($_POST['user']) && isset($_POST['pass']))) {
    header('Location:login.html');
}
//ユーザ名 / パスワード
$user = htmlspecialchars($_POST['user'], ENT_QUOTES);
$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
//DBへの接続
$dbh = connectDB(); 

if ($dbh) {
    //データベースへの問い合わせSQL文(文字列)
    $sql = 'SELECT `user_name` FROM `user_tb`
            WHERE `login_name` = "' . $user . '"
            AND `login_password` = "' . $pass . '"';

    $sth = $dbh->query($sql); //SQLの実行
    //データの取得
    $result = $sth->fetchALL(PDO::FETCH_ASSOC);
}


//認証
//if (($user == 'x22004') && ($pass == 'webphp')) {
    if(count($result) == 1){//配列数が唯一の場合
    //ログイン成功
    $login = 'OK';
    //表示用ユーザ名をセッション変数に保存
    $_SESSION['name'] = $result[0]['user_name'];
} else {
    //ログイン失敗
    $login = 'Error';
}
$sth = null; //データの消去
$dbh = null; //DBを閉じる

//セッション変数に代入
$_SESSION['login'] = $login;

//移動
if ($login == 'OK') {
    //ログイン成功 : 掲示板メニュー画面へ
    header('Location: ok_login.php');
    exit();
} else {
    //ログイン失敗 : ログインフォーム画面へ
    header('Location: login.html');
    exit();
}
?>