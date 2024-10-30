<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $file_name = "mydata.csv";
    try{
        //ファイルオブジェクトの作成
        $file_obj = new SplFileObject($file_name, "rb");
    }catch(Exception $e){
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
        <thead>
            <th>証券番号</th>
            <th>企業名</th>
            <th>株価</th>
            <th>前日比</th>
        </thead>
        <?php
        foreach ($file_obj as $one_line_arr){
            list($id, $name, $price, $ratio) = $one_line_arr; //1行ずつ取得
            echo '<tr>';
                echo '<td>' . htmlspecialchars($id, ENT_QUOTES) . '</td>';
                echo '<td>' . htmlspecialchars($name, ENT_QUOTES) . '</td>';
                echo '<td>' . htmlspecialchars(number_format($price), ENT_QUOTES) . '</td>';
                echo '<td>' . htmlspecialchars(number_format($ratio), ENT_QUOTES) . '</td>';
                echo '</tr>';
        }
        ?>
    </table>
</body>
</html>