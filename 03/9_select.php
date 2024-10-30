<?php
function createSelect($size){
    echo '<select name="select"> size=' . $size . ">";
for ($i=0; $i < $size; $i++) { 
    echo '<option value="select' . $i . '>選択リスト' . $i . "</option>";
}
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
    <?php createSelect(4);?>
</body>
</html>