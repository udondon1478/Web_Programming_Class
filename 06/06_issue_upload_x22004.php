<?php
session_start();    //セッション開始
//前のページから受け取ったSESSIONのデータを変数に格納
if (isset($_SESSION['name']) && isset($_SESSION['comment'])) {
    $name = $_SESSION['name'];
    $comment = $_SESSION['comment'];
} else {
    //セッションが空の場合
    $error[] = 'セッションエラーです';
}
$error = []; //エラーの初期化
$file_name = $_SESSION['filename'];
$file_type = $_SESSION['filetype'];
$temp_name = $_SESSION['tmp_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/issue_upload.css">
</head>

<body>
    <?php
    $array[] = $name;
    $array[] = $comment;
    $array[] = $file_name;
    ?>

    <?php
    $array = array();
    foreach ($_SESSION as $key => $value) {
        $array[$key] = $value;
    }


    //csvファイルに書き込み
    $data_file_name = "data.csv";
    try {
        $file_obj = new SplFileObject($data_file_name, "ab");
    } catch (Exception $e) {
        echo '<span>ファイルに保存できませんでした。</span>';
        $err = $e->getMessage();
        exit($err);
    }

    if (!isset($_FILES['filename']['error']) || is_array($_FILES['filename']['error'])) {
        // 画像をアップロードしない場合の処理
        $array['name'] = '\'\''; // CSVファイルにシングルクオーテーションを書き込む
    } else {
        // 画像をアップロードする場合の処理
        $array['name'] = $_FILES['filename']['name']; // CSVファイルにファイル名を書き込む
    }
    $file_obj->fputcsv($array);
    echo '<span>登録しました。</span><br>';
    ?>


    <br>
    <a href="./06_issue_submit_x22004.html">登録に移動</a><br>
    <a href="./06_issue_view_x22004.php">一覧に移動</a>
</body>

</html>