<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $arr = array(1, 3, 5, 7, 9);
    $total = 0;
    for($i = 0; $i < 5; $i++){
        $total += $arr[$i];
    }

    echo $total;
    ?>
</body>
</html>