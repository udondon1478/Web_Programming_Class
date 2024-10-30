<?php
session_start();    //セッション開始
//戻る時の対応
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
} else {
    $name = '';
}
if(isset($_SESSION['fruit'])){
    $fruit = $_SESSION['fruit'];
} else {
    $fruit = '';
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
    アンケート(1/2)<br>
    <form method="POST" action="9_dogcat.php">
        <ul>
            <li>
                <label>名前:
                    <input type="text" name="name" placeholder="ニックネーム可" value="<?php echo $name; ?>">
                </label>
            </li>
            <li>
                <label>好きな食べ物
                    <input type="text" name="fruit" value="<?php echo $fruit; ?>">
                </label>
            </li>
        </ul>
        <input type="submit" value="次へ">
    </form>
</body>
</html>