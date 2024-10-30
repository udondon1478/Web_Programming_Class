<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/menu.css">
</head>

<body>
    <div class="loginfo-container">
        <div class="loginfo">
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
        </div>
    </div>
    <hr>

    <div class="menu-container">
        <h1>▪️掲示板メニュー <br></h1>
        <div class="menu-items">

            <a href="write_message.php">メッセージを書く</a> <br>
            <a href="show_message.php">メッセージを読む</a> <br>
        </div>

    </div>


    <div class="logout">
        <a href="logout.php">【ログアウト】</a> <br>

    </div>
    <hr>
</body>

</html>