<?php
session_start();    //セッション開始

$error = []; //エラーの初期化

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} else {
    $error[] = '名前を入力してください';
}

if (isset($_SESSION['fruit'])) {
    $fruit = $_SESSION['fruit'];
} else {
    $error[] = '果物を入力してください';
}

//前のページから受け取ったPOSTのデータを取得
if (isset($_POST['dogcat'])) {
    $dogcat = $_POST['dogcat'];
    //値のチェック(第一引数の配列の内、第二引数に含まれていない値の配列を返す)
    $diff_val = array_diff($dogcat, ['犬', '猫']);
    //規定外の値が含まれていたらエラー
    if (count($diff_val) > 0) {
        $error[] = "犬好き・猫好きの回答にエラーがありました";
        $_SESSION['dogcat'] = [];
    } else { //OKの場合
        $dogcat_str = implode("好きで, ", $dogcat) . "好きです";
        $_SESSION['dogcat_str'] = $dogcat_str;
        $_SESSION['dogcat'] = $dogcat;
    }
} else {
    $dogcat_str = "どちらも好きではありません";
    $_SESSION['dogcat_str'] = $dogcat_str;
    $_SESSION['dogcat'] = [];
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
            <input type="button" value="戻る" onclick="location.href='8_input.php'">
        </span>
    <?php } else { ?>
        <!--エラーがなかった時 -->
        <span>
            名前: <?php echo $name; ?><br>
            果物: <?php echo $fruit; ?><br>
            犬猫好き: <?php echo $dogcat_str; ?><br>
        </span>
        <input type="button" value="訂正する" onclick="location.href='8_input.php'">
        <input type="button" value="送信する" onclick="location.href='11_thankyou.php'">
    <?php } ?>
</body>

</html>