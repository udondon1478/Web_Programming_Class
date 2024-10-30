<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>受信</title>
</head>
<body>
    あなたが入力した文字列は「
    <?php
        $text2 = $_POST["text1"];
        echo $text2;
    ?>
    」です。
</body>
</html>