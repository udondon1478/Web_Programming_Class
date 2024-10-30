<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $w = 3;
    $h = 2;
    for($y = 0; $y < $h; $y++) {
        for($x = 0; $x < $w; $x++){
            echo '<img src="img/wow.png">';
        }
        echo "<br>";
    }
    ?>
</body>
</html>