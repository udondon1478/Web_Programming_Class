<?php 
function university ($name) {
    return ($name . "大学");
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
    <?php
    echo university("愛知工業");
    ?>
</body>
</html>