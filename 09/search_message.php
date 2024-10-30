<?php
//セッションの開始
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
    <link rel="stylesheet" href="./css/write.css">
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
        <div class="menu-items">
            <a href="menu_message.php">【メニュー】</a>

        </div>
    </div>
    <hr>

    <div class="form-container">
        <form action="./search_result.php" method="POST">
            ▪️メッセージの検索。 <br>

            メッセージID: <br>
            <input type="text" name="id" class="form-control" size="50"> <br>

            メッセージタイトル: <br>
            <textarea name="title" class="form-control" cols="40" rows="5"></textarea> <br>

            <input type="submit" value="メッセージの登録"> <br>
        </form>

    </div>
    <hr>

    <div class="logout">
            <a href="logout.php">【ログアウト】</a> <br>
        </div>
</body>

</html>