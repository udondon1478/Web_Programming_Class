<?php
session_start();    //セッション開始

$error = []; //エラーの初期化

if(isset($_POST['animal'])){
    $_SESSION['animal'] = trim($_POST['animal']);
}else {
    $error[] = '動物名を入力してください';
}
if(isset($_POST['comment'])){
    $_SESSION['comment'] = trim($_POST['comment']);
} else {
    $error[] = 'コメントが未入力です';
}
if(isset($_FILES['filename']['name'])){
    $_SESSION['filename'] = trim($_FILES['filename']['name']);
} else {
    $error[] = '画像を選択してください';

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (count($error) > 0) { ?>
        <!--エラーがあった時-->
        <span><?php echo implode('<br>', $error); ?></span><br>
        <span>
            <input type="button" value="戻る" onclick="location.href='06_submit_x22004.php'">
        </span>
    <?php } else { ?>
        <!--エラーがなかった時 -->
        <span>
            動物名: <?php echo $_SESSION['animal']; ?><br>
            コメント: <?php echo $_SESSION['comment']; ?><br>
            ファイル名: <?php echo $_SESSION['filename']; ?><br>
        </span>
        <input type="button" value="訂正する" onclick="location.href='06_submit_x22004.php'">
        <input type="button" value="送信する" onclick="location.href='11_thankyou.php'">
    <?php } ?>
</body>

</html>