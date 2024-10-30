<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/issue_view.css">
</head>

<body>
    <?php
    $file_name = "data.csv";
    try {
        //ファイルオブジェクトの作成
        $file_obj = new SplFileObject($file_name, "rb");
    } catch (Exception $e) {
        echo '<span>エラーがありました</span><br>';
        $err = $e->getMessage();
        exit($err);
    }
    //csvファイルの読み込み
    $file_obj->setFlags(
        SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
    );
    ?>
    <table border="1">
        <?php
        $i = 0;
        echo '<tr>';
        foreach ($file_obj as $one_lien_arr) {
            if ($i % 3 == 0 && $i != 0) {
                echo '</tr><tr>';
            }
            list($name, $comment, $img) = $one_lien_arr; //1行ずつ取得
            echo '<td>';
            echo '<img src="uploads/s/' . $img . '" alt="動物画像" ' . 'onerror="this.src=\'img/noimage.png\'"><br>';
            echo '<b>' . $name . '</b><br>';
            echo $comment;
            echo '</td>';

            $i++;
        }
        ?>
    </table>
    <a href="./06_issue_submit_x22004.php">登録に移動</a>
</body>

</html>