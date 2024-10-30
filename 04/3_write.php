<pre>
<?php
$lecture = 'Webプログラミングおよび演習';
$msg = <<< 'EOD'
これから"$lecture"を学びましょう!
復讐を忘れずに!
EOD;

?>

<?php
$file_name="mytext.txt";
try{
    //ファイルオブジェクトの生成
    $file_obj=new SplFileObject($file_name, "wb");
}catch (Exception $e) {
    echo '<span>ファイルに保存できませんでした。</span>'
    $err=$e->getMessage();
    exit($err);
}
//ファイルに書き込む
$written = $file_obj->fwrite($write_data);
if($written === FALSE) {
    echo '<span>ファイルに保存できませんでした</span>';
}else{
    echo "SplFileObjectのfwriteを使用して,<br>{$file_name}に{$written}バイトを書き出しました. <hr>";
}
?>
</body>
</html>
echo $msg;
?>
</pre>