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
<html lang="ja">

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
        <hr>

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

        <form action="delete_confirm2.php" method="POST" name="delForm">
            <input class="btn btn-primary" type="submit" value="削除" onClick="return delRecordAlert()">
        </form>
        <hr>

        <div class="logout">
            <a class="btn btn-primary" href="logout.php">【ログアウト】</a> <br>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>