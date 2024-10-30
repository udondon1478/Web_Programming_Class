<?php
session_start();    //セッション開始
//「訂正する」が押された場合の画像の削除
if ($_POST != '') {
    //画像ファイルの削除
    unlink('./uploads/' . $_SESSION['filename']);
    unlink('./uploads/s/' . $_SESSION['filename']);
}

    //戻る時の対応
    if ($_SESSION['animal'] != '') {
        $animal = $_SESSION['animal'];
    } else {
        $animal = '';
    }
if ($_SESSION['comment'] != '') {
    $comment = $_SESSION['comment'];
} else {
    $comment = '';
}

if ($_SESSION['filename'] != '') {
    $filename = $_SESSION['filename'];
} else {
    $filename = '';
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/issue_submit.css">
</head>

<body>
    <div class="item-container">
        <h1>アップロードする画像ファイル(JPEG形式)を入力してください。</h1><br>
        <form action="06_issue_confirm_x22004.php" method="POST" enctype="multipart/form-data">
            <!--動物の種類を入力するフォームを作成-->
            動物の種類:
            <input type="text" name="animal" placeholder="動物の種類を入力してください" size="30" value="<?php echo $animal; ?>"><br>
            コメント:
            <input type="text" name="comment" placeholder="コメントを入力してください" size="25" value="<?php echo $comment; ?>"><br>
            画像ファイル:<br>
            <input type="file" name="filename" size="50" value="<?php echo $filename; ?>"><br>
            <input type="submit" value="登録">
        </form>
    </div>

</body>

</html>