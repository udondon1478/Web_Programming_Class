<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');

if ($_POST['id'] == "" && $_POST['title'] == "") {
    header('Location: search_message.php');
}
?>

<?php
//DBへの接続
$dbh = connectDB();
$flag = 0;
$sql = 'SELECT `message_id`,`message_title`,`message`,`user_name`,`entry_date`
    FROM `message_tb`
    WHERE';

if (isset($_POST['id']) && $_POST['id'] != "") {
    $sql .= ' `message_id` = "' . $_POST['id'] . '"';
    $flag = 1;
}

if (isset($_POST['title']) && $_POST['title'] != "") {
    if ($flag == 1) {
        $sql .= ' OR ';
    }
    $sql .= ' `message_title` LIKE "%' . $_POST['title'] . '%"';
}

/*
if ($dbh) {
    //データベースへの問い合わせSQL文(文字列)
    $sql = 'SELECT `message_id`,`message_title`,`message`,`user_name`,`entry_date`
    FROM `message_tb`
    WHERE';

    $sth = $dbh->query($sql); //SQLの実行
}
*/
$sth = $dbh->query($sql); //SQLの実行
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
    <div class="container">
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

        <div class="menu container">
            <h1>▪️掲示板メニュー <br></h1>
            <nav class="navbar navbar-expand-sm">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="write_message.php">メッセージを書く</a> <br>
                    <a class="nav-item nav-link" href="show_message.php">メッセージを読む</a> <br>
                    <a class="nav-item nav-link" href="search_message.php">メッセージを探す</a> <br>
                    <a class="nav-item nav-link" href="delete_message.php">メッセージを削除する</a> <br>
                    <a class="nav-item nav-link" href="account_list.php">アカウント一覧</a> <br>
                </div>
            </nav>

        </div>
        <hr>

        <table class="table" border=1>
            <thread>
            <tr bgcolor="#cccccc">
                <th scope="col">ID</th>
                <th class="col">タイトル</th>
                <th class="col">メッセージ</th>
                <th class="col">ユーザ</th>
                <th class="col">投稿日時</th>
                </tr>
            </thread>

                <?php
                //データの取り出し
                while ($row = $sth->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['message_id'] . '</td>';
                    echo '<td>' . $row['message_title'] . '</td>';
                    echo '<td>' . nl2br($row['message']) . '</td>';
                    echo '<td>' . $row['user_name'] . '</td>';
                    echo '<td>' . $row['entry_date'] . '</td>';
                    echo '</tr>';
                }
                ?>
        </table>
        <hr>

        <div class="logout">
            <a class="btn btn-primary" href="logout.php">【ログアウト】</a> <br>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>