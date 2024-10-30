<?php
    //セッションの開始
    session_start();
    ?>

<?php
    //ログイン画面
    if((isset($_SESSION['login']) && $_SESSION['login'] == 'OK')){
        //ログイン成功
        echo '▪️ログイン中です.' . '<br>';
        echo '接続ユーザ: ' . $_SESSION['name'] . '<br>';
    } else {
        //ログイン失敗
        echo 'ログインしてください.';
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
    
</body>
</html>