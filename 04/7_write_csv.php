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
    $arr = array(array("証券番号"=>3851, "企業名"=>"日本一ソフトウェア", "株価"=>1491, "前日比"=>23),
    array("証券番号"=>2148, "企業名"=>"アイティメディア","株価"=>2371,"前日比"=>-14),
    array("証券番号"=>8739,"企業名"=>"スパークス・グループ","株価"=>311,"前日比"=>-7));
    try{
        //ファイルオブジェクトの生成
        $file_obj=new SplFileObject($file_name, "wb");
    }catch (Exception $e){
        echo '<span>ファイルに保存できませんでした。</span>';
        $err = $e->getMessage();
        exit($err);
    }
    //データをcsvに保存
    foreach($arr as $one_line){
        $file_obj->fputcsv($one_line);
    }
    echo "{$file_name}の書き出しが終わりました";
    ?>
</body>
</html>