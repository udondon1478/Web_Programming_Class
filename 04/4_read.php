<pre>
<!DOCTYPE html>
<html lang="ja">
<body>

<?php
$file_name="mytext.txt";
try{
    //ファイルオブジェクトの生成
    $file_obj=new SplFileObject($file_name, "rb");
}catch (Exception $e) {
    echo '<span>エラーがありました</span><br>'
    $err = $e->getMessage();
    exit($err);
}
//ファイルに書き込む
$written = $file_obj->fwrite($write_data);
if($written === FALSE) {
    echo '<span>ファイルに保存できませんでした</span>';
}else{
    echo "SplFileObjectのfwriteを使用して,<br>{$file_name}に{$written}バイトを書き出しました. <hr>";
}

//文字列の読み込み
$read_data = $file_obj->($file_obj->getSize());
if(!($read_data === FALSE)){
    //HTMLエスケープ
    $read_data = htmlspecialchars($read_data, ENT_QUOTES);
    //改行コードの前に<br>の挿入
    $read_data_br = nl2b($read_data, false);
    echo "{$file_name}を読み込みました. <br>";
    echo $read_data_br. "<hr>";//ファイルの中身の表示
}else{
    echo '<span>ファイルを読み込めませんでした</span><br>';
}
?>
</body>
</html>
echo $msg;
?>
</pre>