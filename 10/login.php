<?php
session_start();
//$_SESSION['hash']をコンソールに出力
var_dump($_SESSION['hash']);
?>

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="form container">
        <h1>ユーザ名とパスワードを入力してください.<br></h1>
        <!-- ハッシュ値を表示 -->
        <p>ハッシュ値:<?php echo $_SESSION['hash']; ?></p>
        <form action="check_login.php" method="POST">
            ユーザ名: <input type="text" name="user" class="form-control" size="30"><br>
            パスワード: <input type="password" name="pass" class="form-control" size="30"><br>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>