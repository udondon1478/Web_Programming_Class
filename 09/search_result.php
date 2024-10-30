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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/show.css">
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

    <table border=1>
        <tr bgcolor="#cccccc">
            <th>ID</td>
            <th>タイトル</th>
            <th>メッセージ</th>
            <th>ユーザ</th>
            <th>投稿日時</th>
        </tr>
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
        <a href="logout.php">【ログアウト】</a> <br>
    </div>
</body>

</html>