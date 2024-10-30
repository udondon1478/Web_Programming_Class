<?php
//POSTされたデータの取り出し
if(!isset($_POST['memo'])){
    //POSTメッセージが存在しない場合は,何もせずにトップに移動
    header('Location:04_issue_top_x22004.php');
    exit();
}

$memo= htmlspecialchars($_POST['memo'], ENT_QUOTES);
$date=date("y/n/j G:i:s", time());  //時刻の取得
//課題!!
$write_data = '<div class="thread">' . $date . "\n" . $memo . "</div>" . "\n";
//メモファイル
$filename = "memo.txt";
try{
    //ファイルオブジェクトの生成
    $file_obj=new SplFileObject($filename, "a+b");
}catch (Exception $e) {
    echo '<span>ファイルに保存できませんでした。</span>';
    $err = $e->getMessage();
    exit($err);
}

//ファイルロック
$file_obj->flock(LOCK_EX);
//追記
$result = $file_obj -> fwrite($write_data);
//アンロック
$file_obj->flock(LOCK_UN);

//トップページに戻る
header('Location:04_issue_top_x22004.php');