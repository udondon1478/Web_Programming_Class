<?php
session_start();    //セッション開始

$error = []; //エラーの初期化

if($_POST['animal'] != '') {
    $_SESSION['animal'] = trim($_POST['animal']);
}else {
    $error[] = '動物名を入力してください';
}
if($_POST['comment'] != ''){
    $_SESSION['comment'] = trim($_POST['comment']);
} else {
    $error[] = 'コメントを入力してください';
}
if($_FILES['filename']['name'] != ''){
    $_SESSION['filename'] = trim($_FILES['filename']['name']);
} else {
    $error[] = '画像を選択してください';
    $_SESSION['filename'] = '';
}
if($_FILES['filename']['type'] != ''){
    $_SESSION['filetype'] = trim($_FILES['filename']['type']);
}
if($_FILES['filename']['tmp_name'] != ''){
    $_SESSION['tmp_name'] = trim($_FILES['filename']['tmp_name']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--画像ファイル関連の処理-->
    <?php
    //ファイル名の取り出し
    $file_name = $_FILES['filename']['name'];
    //ファイル(MIME)タイプの取り出し
    $file_type = $_FILES['filename']['type'];
    //一時ファイル名の取り出し
    $temp_name = $_FILES['filename']['tmp_name'];

    ?>

<?php

//アップロード先のディレクトリ
$dir = 'uploads/';
//アップロードファイルのパス
$upload_name = $dir . $file_name;
//保存先のディレクトリ
$dir = 'uploads/';
//保存先のファイル名
$upload_name = $dir . $file_name;
//サムネイル画像の保存先のディレクトリ
$dir_s = 'uploads/s/';
//サムネイル画像の保存先のファイル名
$upload_name_s = $dir_s . $file_name;

if (($file_type == 'image/jpeg') || ($file_type == 'image/pjpeg')) {
    //アップロード(移動)
    $result = move_uploaded_file($temp_name, $upload_name);
    if ($result) {
        //アップロードされた画像情報を取り出す
        $image_size = getimagesize($upload_name);
        //幅と高さを取り出す
        $width = $image_size[0]; //幅
        $height = $image_size[1]; //高さ

        //サムネイルの幅と高さを決める
        $width_s = 120;
        $height_s = round($width_s * $height / $width);

        //アップロードされた画像を取り出す
        $image = imagecreatefromjpeg($upload_name);
        //サムネイルの大きさの画像を新規作成
        $image_s = imagecreatetruecolor($width_s, $height_s);

        //アップロードされた画像からサムネイル画像を作成
        $result_s = imagecopyresampled(
            $image_s,
            $image,
            0,
            0,
            0,
            0,
            $width_s,
            $height_s,
            $width,
            $height
        );

        if ($result_s){
            //サムネイル画像の新規作成
            //サムネイル画像の保存関数. (画像, ファイル名)
            if(imagejpeg ($image_s, $upload_name_s)) {
                
            }else{
                
            }
        }else{
            //サムネイル画像の作成失敗
            
        }


        imagedestroy($image);
        imagedestroy($image_s);

    } else {
        //アップロードの失敗
        echo '<div class="result"><h2>' . 'アップロードの失敗' . '</h2></div>';
    }
} else {
    //アップロード(移動)
    $result = move_uploaded_file($temp_name, $upload_name);
    if ($result) {
        
        //アップロードされた画像情報を取り出す
        $image_size = getimagesize($upload_name);
        //幅と高さを取り出す
        $width = $image_size[0]; //幅
        $height = $image_size[1]; //高さ

        //サムネイルの幅と高さを決める
        $width_s = 120;
        $height_s = round($width_s * $height / $width);

        //アップロードされた画像を取り出す
        $image = imagecreatefrompng($upload_name);
        //サムネイルの大きさの画像を新規作成
        $image_s = imagecreatetruecolor($width_s, $height_s);

        //アップロードされた画像からサムネイル画像を作成
        $result_s = imagecopyresampled(
            $image_s,
            $image,
            0,
            0,
            0,
            0,
            $width_s,
            $height_s,
            $width,
            $height
        );

        if ($result_s){
            //サムネイル画像の新規作成
            //サムネイル画像の保存関数. (画像, ファイル名)
            if(imagejpeg ($image_s, $upload_name_s)) {
                
            }else{
                
            }
        }else{
            //サムネイル画像の作成失敗
            
        }

        imagedestroy($image);
        imagedestroy($image_s);

    } else {
        //アップロードの失敗
        echo '<div class="result"><h2>' . 'アップロードの失敗' . '</h2></div>';
    }
}

?>

    <!--表示部-->

    <!--エラーがあった際、エラー内容を出力-->
    <?php if (count($error) > 0) { ?>
        <!--エラーがあった時-->
        <span><?php echo implode('<br>', $error); ?></span><br>
        <span>
            <input type="button" value="戻る" onclick="location.href='06_issue_submit_x22004.php'">
        </span>
    <?php } else { ?>
        <!--エラーがなかった時 -->
        <span>
            動物名: <?php echo $_SESSION['animal']; ?><br>
            コメント: <?php echo $_SESSION['comment']; ?><br>
            ファイル名: <?php echo $_SESSION['filename']; ?><br>

            <img src="<?php echo $upload_name_s; ?>" alt="animal_thumbnail">
        </span>
        <form action="06_issue_submit_x22004.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="edit" value="true">
        <input type="submit" value="訂正する" onclick="location.href='06_issue_submit_x22004.php'">
        </form>
        <input type="button" value="送信する" onclick="location.href='06_issue_upload_x22004.php'">
        <?php } ?>
</body>

</html>