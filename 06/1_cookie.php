<?php
//クッキーの設定は送信部分を最初に記述. 空白・空行もNG
if (isset($_POST['test'])) { //$_POST['test']が存在: 真
    $str = $_POST['test']; //フォームから送られたテキスト
    $t = time() + 60 * 60 * 24;
    setcookie('mydata', $str, $t);  //cookieのセット
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_COOKIE['mydata'])) { //クッキー'mydata'の存在確認
        echo "現在保持されているクッキー:" . $_COOKIE['mydata'] . "<br>";
    } else {
        echo "現在、クッキーは保存されていません. <br>";
    }
    ?>
    <br>
    *クッキー登録
    <form method="post" action="1_cookie.php">
        <input type="text" name="test">
        <input type="submit">
    </form>
</body>

</html>