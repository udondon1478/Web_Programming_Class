<?php
    function ageMessage($age){
        if($age >= 20){
            return "成年です。";
        }else{
            return "未成年です。";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($_POST['age'] >= 18)
    $name1 = $_POST['name'];
    $name1 = htmlspecialchars($name1);
    $age1 = $_POST['age'];
    $age1 = htmlspecialchars($age1);
    echo $name1 . "さんは" . ageMessage($age1) . "<br>";
    ?>
    <?php
    if (isset($_POST['check'])) {
        echo "お知らせメールをお送りします。 <br>";
    }else{
        echo "お知らせメールをお送りしません。 <br>";
    }
    ?>
    <?php
    $transaction_ID = $_POST['transaction_ID'];
    echo "トランザクションID: " . $transaction_ID;
    ?>
</body>
</html>