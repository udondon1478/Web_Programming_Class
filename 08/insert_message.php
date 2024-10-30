<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
?>

<?php
//ログイン画面
if ((isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    //ログイン成功
    echo 'Login: ' . $_SESSION['name'] . '<br>' . '<hr>';
} else {
    //ログイン失敗
    echo 'ログインしてください.';
}
?>

<?php
$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$message = htmlspecialchars($_POST['message'], ENT_QUOTES);
?>

<?php
//DBへの接続
$dbh = connectDB();

if ($dbh) {
    //データベースへ書き込むSQL文
    $sql = 'INSERT INTO `message_tb`(`message_title`,
    `message`,`user_name`)
    VALUES("' . $title . '", "' . $message . '","' . $_SESSION['name'] . '")';


    $sth = $dbh->query($sql); //SQLの実行

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="menu_message.php">【メニュー】</a>
    <a href="logout.php">【ログアウト】</a> <br>
    <hr>

    ▪️メッセージを登録しました <br>

    <a href="read_message.php">メッセージを読む
    </a>

</body>

</html>