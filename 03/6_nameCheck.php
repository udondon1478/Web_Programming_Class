<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <?php
    $is_error = false;
    if (isset($_POST['name'])){
        $name = trim($_POST['name']);
        if ($name=="") {
            $is_error = true;
        }
    }else{
        $is_error = true;
    }
    ?>
    <?php if ($is_error): ?>
        <span>名前を入力してください</span>
        <form method="POST" action="5_nameCheckForm.html">
            <input type="submit" value="戻る">
        </form>
    <?php else: ?>
        <span>
            こんにちは、<?php echo $name; ?> さん
        </span>
        <?php endif; ?>
</body>
</html>