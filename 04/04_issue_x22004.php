<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
</head>

<body>
    メモ帳
    <hr>
    <?php
    $file_name = "memo.txt";
    try {
        //ファイルオブジェクトの生成
        $file_obj = new SplFileObject($file_name, "rb");
    } catch (Exception $e) {
        echo '<span>エラーがありました</span><br>';
        $err = $e->getMessage();
        exit($err);
    }
    if ($file_obj->getSize() > 0) {
        //文字列の読み込み
        $read_data = $file_obj->fread($file_obj->getSize());
        if (!($read_data === false)) {
            //改行コードの前に<br>の挿入
            $read_data_br = nl2br($read_data, false);
            //ファイルの中身の表示
            echo $read_data_br . "<hr>";
        } else {
            echo '<span>ファイルを読み込めませんでした</span><br>';
        }
    }
    ?>
    <form action="6_append.php" method="POST">
        メモ<br>
        <textarea name="memo" rows="4" cols="40" placeholder="メモを書く"></textarea><br>
        <input type="submit" value="登録">
    </form>

    </hr>
</body>

</html>