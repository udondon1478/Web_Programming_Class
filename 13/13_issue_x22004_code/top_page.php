<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
//DBへの接続
$dbh = connectDB();
//データベースの接続確認
if (!$dbh) {
    //接続できていない場合
    echo 'DBに接続できていません';
    exit();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">-->
    <link href="./css/style.css" rel="stylesheet">
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


        <div class="logout">
            <a class="btn btn-primary" href="logout.php">【ログアウト】</a> <br>
        </div>
        <hr>

        <div id="container">
            <div id="channels">
                <h2>チャンネル一覧</h2>
                <div class="channel-list">
                    <ul>
                        <!--チャンネルにリンク(GET)-->
                        <?php
                        $sql = "SELECT * FROM `channel_tb`";
                        $sth = $dbh->prepare($sql); //SQLの準備
                        $sth->execute(); //SQLの実行
                        $result = $sth->fetchAll(PDO::FETCH_ASSOC); //結果の取得

                        //$_SESSION['admin_flag']がTRUEの場合
                        if ($_SESSION['admin_flag'] == 1) {
                            foreach ($result as $row) {
                                echo '<li><a href="top_page.php?channel_id=' . $row['id'] . '">' . $row['name'] . '</a>';
                                if ($row['is_public'] == 1) {
                                    echo '(公開)';
                                } else {
                                    echo '(非公開)';
                                }
                                echo '</li>';
                            }
                        } else {
                            foreach ($result as $row) {
                                if ($row['is_public'] == 1) {
                                    echo '<li><a href="top_page.php?channel_id=' . $row['id'] . '">' . $row['name'] . '</a>';
                                    echo '(公開)';
                                    echo '</li>';
                                }
                            }
                        }


                        ?>
                    </ul>
                </div>
            </div>

            <div id="posts">
                <h2>投稿一覧</h2>
                <!--投稿一覧の表示-->
                <?php
                if (isset($_GET['channel_id'])) {
                    //チャンネルIDが指定されている場合
                    $sql = "SELECT * FROM `post_tb` WHERE `channel_id` = :channel_id";
                    $sth = $dbh->prepare($sql); //SQLの準備
                    $sth->bindValue(':channel_id', $_GET['channel_id'], PDO::PARAM_INT); //プレースホルダーに値をバインド
                    $sth->execute(); //SQLの実行
                    $result = $sth->fetchAll(PDO::FETCH_ASSOC); //結果の取得
                    foreach ($result as $row) {
                        echo '<div class="post">';
                        echo '<div class="post-info">';
                        echo '<span class="post-user">' . $row['name'] . '</span>';
                        echo '<span class="post-date">' . $row['created_at'] . '</span>';
                        echo '</div>';
                        echo '<div class="post-content">';
                        echo $row['content'];
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '<h2>投稿フォーム</h2>';
                    echo '<form action="top_page.php?channel_id=' . $_GET['channel_id'] . '" method="get">';
                    echo '<input type="hidden" name="channel_id" value="' . $_GET['channel_id'] . '">';
                    echo '<textarea name="content"></textarea><br>';
                    echo '<input type="submit" value="投稿">';
                    echo '</form>';
                }
                ?>
            </div>

            <!--投稿の挿入-->
            <?php
            if (isset($_GET['channel_id']) && isset($_GET['content'])) {
                //DBへの接続
                $dbh = connectDB();
                //データベースの接続確認
                if (!$dbh) {
                    //接続できていない場合
                    echo 'DBに接続できていません';
                    exit();
                }
                //データベースへの問い合わせSQL文(文字列)
                $sql = "INSERT INTO `post_tb` (`channel_id`,`user_id`,`name`,`content`) VALUES (:channel_id,:user_id,:name,:content)";
                $sth = $dbh->prepare($sql); //SQLの準備
                $sth->bindValue(':channel_id', $_GET['channel_id'], PDO::PARAM_INT); //値のバインド
                $sth->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT); //値のバインド
                $sth->bindValue(':name', $_SESSION['name'], PDO::PARAM_STR); //値のバインド
                $sth->bindValue(':content', $_GET['content'], PDO::PARAM_STR); //値のバインド
                $sth->execute(); //SQLの実行
                echo '投稿しました';
            }
            ?>


        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>