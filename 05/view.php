<h1>画像一覧</h1>
<?php
//保存先のディレクトリ
$dir = 'uploads/';
$dir_s = 'uploads/s/';

//ディレクトリ内のファイルを取り出す
$files = scandir($dir_s);

//ファイルの取り出し
foreach ($files as $file) {
    //ファイル情報を取り出す
    $file_info = pathinfo($file);
    //ファイル名
    $file_name = $file_info['basename'];
    //ファイルの拡張子
    $file_ext = $file_info['extension'];
    //JPEG形式のファイルを表示する
    if ($file_ext == 'jpg' || $file_ext == 'JPG') {
        echo 'アップロード画像:' . $dir . $file_name;
        echo '<br>';
        echo 'サムネイル画像:' . $dir_s . $file_name;
        echo '<br>';
    }
}
?>