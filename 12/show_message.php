<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
?>

<?php
//DBへの接続
$dbh = connectDB();
if ($dbh) {
    //「user_name」が$_SESSION[`user_name`]と一致するレコード群の情報を取得

    //「user_tb」の「admin_flag」が1の時だけ全てのメッセージを表示
    $sql = 'SELECT `admin_flag` FROM `user_tb` WHERE `user_name` = :user_name';
    $sth = $dbh->prepare($sql); //SQLの準備
    $sth->bindValue(':user_name', $_SESSION['name'], PDO::PARAM_STR); //プレースホルダーに値をバインド
    $sth->execute(); //SQLの実行
    $buff2 = $sth->fetch(PDO::FETCH_ASSOC); //結果の取得

    //「message_tb」の全てのメッセージを取得
    $sql = 'SELECT `message_id`,`message_title`,`message`,`user_name`,`entry_date` FROM `message_tb` ORDER BY `message_id` DESC';
    $sth = $dbh->prepare($sql); //SQLの準備
    $sth->execute(); //SQLの実行
    $buff3 = $sth->fetch(PDO::FETCH_ASSOC); //結果の取得
}
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
                    <a class="nav-item nav-link" href="message.php">message.phpを表示</a>
                    <a class="nav-item nav-link" href="write_message.php">メッセージを書く</a> <br>
                    <a class="nav-item nav-link" href="show_message.php">メッセージを読む</a> <br>
                    <a class="nav-item nav-link" href="search_message.php">メッセージを探す</a> <br>
                    <a class="nav-item nav-link" href="delete_message.php">メッセージを削除する</a> <br>
                    <a class="nav-item nav-link" href="account_list.php">アカウント一覧</a> <br>
                </div>
            </nav>

        </div>

        <!-- $_SESSION['user_name']の書き出し -->
        <div class="user_name">
            <?php
            echo 'ユーザ名: ' . $_SESSION['name'] . '<br>';
            ?>

            <hr>

            <form action="delete_confirm.php" method="POST">
                <table class="table" border=1>
                    <tr bgcolor="#cccccc">
                        <th scope="col">削除</th>
                        <th scope="col">ID</th>
                        <th class="col">タイトル</th>
                        <th class="col">メッセージ</th>
                        <th class="col">ユーザ</th>
                        <th class="col">投稿日時</th>
                    </tr>
                    <!-- admin_flagが1だった場合 -->
                    <?php
                    $user = $_SESSION['name'];

                    if ($buff2['admin_flag'] == 1) {
                        //コンソールに結果を表示
                        echo '<script>console.log("admin_flagが1です")</script>';
                        //データの取り出し
                        while ($buff3) {

                            echo '<tr>';
                            echo '<td><input type="checkbox" name="check[]" value="' .
                                $buff3['message_id'] . '"></td>';
                            echo '<td>' . $buff3['message_id'] . '</td>';
                            echo '<td>' . $buff3['message_title'] . '</td>';
                            echo '<td>' . nl2br($buff3['message']) . '</td>';
                            echo '<td>' . $buff3['user_name'] . '</td>';
                            echo '<td>' . $buff3['entry_date'] . '</td>';
                            echo '</tr>';

                            $buff3 = $sth->fetch(PDO::FETCH_ASSOC); //結果の取得
                        }
                    } else {
                        //コンソールに結果を表示
                        echo '<script>console.log("admin_flagが1ではありません")</script>';
                        //データの取り出し
                        //`user_name`が$_SESSION['name']と一致するレコードの情報を表示
                        //$buff3の中身をwhile文で一つ一つ確認
                        while ($buff3) {
                            if ($buff3['user_name'] == $user) {
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="check[]" value="' .
                                    $buff3['message_id'] . '"></td>';
                                echo '<td>' . $buff3['message_id'] . '</td>';
                                echo '<td>' . $buff3['message_title'] . '</td>';
                                echo '<td>' . nl2br($buff3['message']) . '</td>';
                                echo '<td>' . $buff3['user_name'] . '</td>';
                                echo '<td>' . $buff3['entry_date'] . '</td>';
                                echo '</tr>';
                            }
                            $buff3 = $sth->fetch(PDO::FETCH_ASSOC); //結果の取得
                        }
                    }
                    ?>
                </table>
                <input class="btn btn-primary" type="submit" value="削除">
                <input class="btn btn-primary" type="reset" value="リセット">
            </form>



            <div class="logout">
                <a class="btn btn-primary" href="logout.php">【ログアウト】</a> <br>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>