<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $arr = array("a", "b", "c", "d", "e");
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    array_unshift($arr, "x", "y", "z");

    echo "<pre>";

    print_r($arr);

    echo "</pre>";
    ?>
</body>
</html>