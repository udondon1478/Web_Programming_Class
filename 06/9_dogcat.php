<?php
session_start();    //セッション開始
//前のページから受け取ったPOSTのデータをSESSIONに格納
if(isset($_POST['name'])){
    $_SESSION['name'] = trim($_POST['name']);
}
if(isset($_POST['fruit'])){
    $_SESSION['fruit'] = trim($_POST['fruit']);
}
$dogcat = [];
if(isset($_SESSION['dogcat'])) {
    $dogcat = $_SESSION['dogcat'];
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
    アンケート (2/2)<br>
    <form method="POST" action="10_confirm.php">
        <span>犬が好きですか. 猫が好きですか. </span><br>
        <label>
            <input type="checkbox" name="dogcat[]" value="犬" <?php
            if (in_array("犬", $dogcat)) {
                echo "checked";
            }
            ?>>犬が好き
        </label><br>
        <label>
            <input type="checkbox" name="dogcat[]" value="猫" <?php
            if(in_array("猫", $dogcat)){
                echo "checked";
            }?>>猫が好き
        </label><br>
        <input type="button" value="戻る" onclick="location.href='8_input.php'">
        <input type="submit" value="次へ">
    </form>
</body>
</html>