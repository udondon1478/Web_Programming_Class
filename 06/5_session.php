<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //フォームから変数usernameが送信されている確認
    if (isset($_POST['username'])) {
        $name = $_POST['username'];
        $_SESSION['id'] = $name;
        //$_SESSION[]: セッション中の情報を格納する連想配列
    }
    //$_SESSION['id']が空でない時はセッション継続中
    if (isset($_SESSION['id'])) {
        echo "ログインしています";
    } else {
        echo "ログインしていません</body></html>";
        die; //スクリプトを修了して以下の処理はしない
    }
    ?>
    <br><br>
    <h3>*ログインしている時だけ表示されます</h3>
    現在のログイン名: <?php echo $_SESSION['id']; ?>
</body>

</html>