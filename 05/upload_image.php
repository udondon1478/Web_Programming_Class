
<body>
    <?php
    //ファイル名の取り出し
    $file_name = $_FILES['filename']['name'];
    //ファイル(MIME)タイプの取り出し
    $file_type = $_FILES['filename']['type'];
    //一時ファイル名の取り出し
    $temp_name = $_FILES['filename']['tmp_name'];
    ?>
    <br>
    画像ファイル: <?php echo $file_name; ?><br>
    MIMEファイル: <?php echo $file_type; ?><br>
    一時ファイル名: <?php echo $temp_name; ?><br>

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


    //アップロードファイルを移動する
    if (($file_type == 'image/jpeg' ||
            $file_type == 'image/pjpeg') ||
        ($file_type == 'image/png')
    ) {
        //アップロード(移動)
        $result = move_uploaded_file($temp_name, $upload_name);
        if ($result) {
            //アップロードの成功
            echo 'アップロードの成功';
            //アップロードされた画像情報を取り出す
            $image_size = getimagesize($upload_name);
            //幅と高さを取り出す
            $width = $image_size[0]; //幅
            $height = $image_size[1]; //高さ

            //サムネイルの幅と高さを決める
            $width_s = 120;
            $height_s = round($width_s * $height / $width);

            //アップロードされた画像を取り出す
            $image = imagecreatefromjpeg ( $upload_name );
            //サムネイルの大きさの画像を新規作成
            $image_s = imagecreatetruecolor ($width_s, $height_s);
    
            //アップロードされた画像からサムネイル画像を作成
            $result_s = imagecopyresampled(
                $image_s, $image,
                0,0,0,0,
                $width_s, $height_s, $width, $height);

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

            //画像の破棄
            imagedestroy ($image);
            imagedestroy ($image_s);

        } else {
            //アップロードの失敗
            echo 'アップロードの失敗';
        }
    } else {
        //JPEG形式以外のファイルの対応
        echo 'JPEG形式の画像をアップロードしてください. ';
    }
    ?>

<br>
    画像ファイル: <?php echo $upload_name; ?> <br>
    <img src="<?php echo $upload_name; ?>"><br>
    サムネイル画像<img src="<?php echo $upload_name_s; ?>">

</body>

</html>