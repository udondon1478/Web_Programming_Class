<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
    <link rel="stylesheet" href="./04_issue_style_x22004.css">
</head>

<body>
    <div class="item-container">
        <img src="./x22004_assets/1500x500.jpeg" alt="GC" class="header">
        <div class="title">
            <img src="./x22004_assets/jqAywOvc_400x400.jpg" alt="icon">
            <div class="title-description">
                <h1>雑多なスレッド</h1>
                <p>Webプロ</p>
            </div>
        </div>

        <form action="04_issue_append_x22004.php" method="POST">
            <div class="form-container">
                <textarea name="memo" rows="4" cols="40" placeholder="{匿名ユーザー}として書き込む"></textarea>
                <input type="submit" value="登録">
            </div>

        </form>

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
                echo '<div class="threads">' . $read_data_br . "</div>" . "<hr>";
            } else {
                echo '<span>ファイルを読み込めませんでした</span><br>';
            }
        }
        ?>
    </div>

</body>

</html>