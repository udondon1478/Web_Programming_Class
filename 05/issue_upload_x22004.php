<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/issue_upload.css">
</head>
<body>
<?php
    //ファイル名の取り出し
    $file_name = $_FILES['filename']['name'];
    //ファイル(MIME)タイプの取り出し
    $file_type = $_FILES['filename']['type'];
    //一時ファイル名の取り出し
    $temp_name = $_FILES['filename']['tmp_name'];
    ?>

    <?php
    $array = array();
    foreach ($_POST as $key => $value) {
        $array[$key] = $value;
    }

    //csvファイルに書き込み
    $data_file_name = "data.csv";
    try {
        $file_obj = new SplFileObject($data_file_name, "ab");
    } catch (Exception $e) {
        echo '<span>ファイルに保存できませんでした。</span>';
        $err = $e->getMessage();
        exit($err);
    }

    if (!isset($_FILES['filename']['error']) || is_array($_FILES['filename']['error'])) {
        // 画像をアップロードしない場合の処理
        $array['name'] = '\'\''; // CSVファイルにシングルクオーテーションを書き込む
    } else {
        // 画像をアップロードする場合の処理
        $array['name'] = $_FILES['filename']['name']; // CSVファイルにファイル名を書き込む
    }
    $file_obj->fputcsv($array);
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
            //アップロードの成功
            echo $upload_name . '<div class="result"><h2>アップロードの成功</h2></div>';
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
                    echo '->サムネイル画像の保存';
                }else{
                    echo '->サムネイル画像の失敗';
                }
            }else{
                //サムネイル画像の作成失敗
                echo '->サムネイル画像の作成失敗';
            }


            imagedestroy($image);
            imagedestroy($image_s);

            echo '<pre>';
            print_r($array);
            echo '</pre>';
        } else {
            //アップロードの失敗
            echo '<div class="result"><h2>' . 'アップロードの失敗' . '</h2></div>';
        }
    } else {
        //アップロード(移動)
        $result = move_uploaded_file($temp_name, $upload_name);
        if ($result) {
            //アップロードの成功
            echo $upload_name . '<div class="result"><h2>アップロードの成功</h2></div>';
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
                    echo '->サムネイル画像の保存';
                }else{
                    echo '->サムネイル画像の失敗';
                }
            }else{
                //サムネイル画像の作成失敗
                echo '->サムネイル画像の作成失敗';
            }

            imagedestroy($image);
            imagedestroy($image_s);

            echo '<pre>';
            print_r($array);
            echo '</pre>';
        } else {
            //アップロードの失敗
            echo '<div class="result"><h2>' . 'アップロードの失敗' . '</h2></div>';
        }
    }

    ?>

    <br>
    <a href="./issue_submit_x22004.html">登録に移動</a><br>
    <a href="./issue_view_x22004.php">一覧に移動</a>
</body>
</html>