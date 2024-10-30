<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "テキスト: ";
    $text1 = $_POST['text1'];
    $text1 = htmlspecialchars($text1);
    echo $text1 . "<br>";
    echo "チェック: ";
    if (isset($_POST['check'])) {
        echo "ON <br>";
    }else{
        echo "OFF <br>";
    }

    echo "ラジオボタン: ";
    $radio = $_POST['radio1'];
    echo htmlspecialchars($radio) . "<br>";
    //選択リスト
    echo "選択リスト: ";
    echo "<ul>";
    $sel = $_POST['select'];
    foreach ($sel as $obj) {
        echo "<li>" . htmlspecialchars($obj) . "<br>";
    }
    echo "</ul>"
    /*
    if (isset($_POST['select'])) {
        $sel = $_POST['select'];
        echo $sel;
    }else {
        echo "選択されていません";
    }
    */
    echo "<br>";
    echo "数字: " . $_POST['number'] . "<br>";
    echo "date: " . $_POST['date'] . "<br>";
    echo "隠しデータ: " . $_POST['hidden'] . "<br>";
    ?>
</body>
</html>