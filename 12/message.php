<?php
//セッションの開始
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 'OK')) {
    header('Location: login.html');
}
//接続用関数の呼び出し
require_once(__DIR__ . '/functions.php');
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
        <div>
            メッセージ内の検索: <input id="search_message">
        </div>

        <hr>
        <div class="form container">

            <div>
                <!-- 入力フォーム -->
                タイトル名: <br>
                <input type="text" id="title" size="50"> <br>
                メッセージ: <br>
                <textarea id="message" col="40" rows="5"></textarea>
                <!-- 送信ボタン -->
                <button id="ajax_add">追加</button>
                <div id="add_result"></div>
            </div>
        </div>

        <div class="container">
            <table class="table" border="1" id="all_show_result">
                <thread>
                    <tr bgcolor="#cccccc">
                        <div class="prep">
                            <th scope="col">ID</th>
                            <th class="col">タイトル</th>
                            <th class="col">メッセージ</th>
                            <th class="col">ユーザ</th>
                            <th class="col">投稿日時</th>
                        </div>
                    </tr>
                </thread>
            </table>
            <hr>
        </div>


        <div class="logout">
            <a class="btn btn-primary" href="logout.php">【ログアウト】</a> <br>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/get_data.js"></script>
</body>

</html>