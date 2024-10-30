<?php
session_start();    //セッション開始
$error = []; //エラーの初期化
if (isset($_SESSION['name']) && isset($_SESSION['fruit']) && isset($_SESSION['dogcat_str'])) {
    $name = $_SESSION['name'];
    $fruit = $_SESSION['fruit'];
    $dogcat_str = $_SESSION['dogcat_str'];
} else {
    $error[] = 'セッションエラーです';
}
//セッションの破棄
$_SESSION = [];
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (count( $error ) > 0) { ?>
        <!-- エラーがあった時 -->

        <span><?php echo implode('<br>', $error); ?></span><br>
        <span>
            <input type="button" value="最初のページに戻る" onclick="location.href='8_input.php'">
        </span>
        <?php } else { ?>
            <!-- エラーがなかった時 -->
            次のように受け付けました、 ありがとうございました.
            <hr>
            <span>
                名前: <?php echo $name; ?><br>
                果物: <?php echo $fruit; ?><br>
                犬猫好き: <?php echo $dogcat_str; ?><br>
            </span>
            <a href="8_input.php">最初のページに戻る</a>
        <?php } ?>
</body>
</html>