<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');

if (!(isset($_POST['check'][0]))) {
    header('Location: delete_message.php');
    exit();
}
?>

<?php
//DBへの接続
$dbh = connectDB();
$flag = 0;
$sql_where = '';
$sql = '';

foreach ($_POST['check'] as $id) {
    if ($flag == false) {
        $flag == true;
    } else {
        $sql_where .= ' OR ';
    }
    //id付与
    $sql_where .= '`message_id`="' . $id . '"';
}

//SELECT文のWHERE句を作成
$sql .= $sql_where;

//データベースへの問い合わせSQL文(文字列)
if ($dbh) {
    //データベースへの問い合わせSQL文(文字列)
    $sql = 'SELECT `message_id`,`message_title`,`message`,`user_name`,`entry_date`
    FROM `message_tb`
    /*WHEREを追加*/
    WHERE' . $sql_where;

    $sth = $dbh->query($sql); //SQLの実行
}

$sql_del = 'DELETE FROM `message_tb` WHERE' . $sql_where;
$_SESSION['delete'] = $sql_del;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script language="JavaScript">
        <!--
        function delRecordAlert() {
            res = confirm("このレコードを削除しますか. \n(この操作は取り消しできません)");
            if (res == true) {
                document.delForm.submit(); //ここで送信
            } else {
                return false;
            }
        }
        -->
    </script>
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

    <form action="delete_confirm2.php" method="POST" name="delForm">
        <input type="submit" value="削除" onClick="return delRecordAlert()">
    </form>
    <hr>

    <div class="logout">
        <a href="logout.php">【ログアウト】</a> <br>
    </div>
</body>

</html>