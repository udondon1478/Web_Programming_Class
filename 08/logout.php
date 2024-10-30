<?php
    //セッション開始
    session_start();
    session_unset();//セッションの初期化
    session_destroy();//セッションの破棄
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ログアウト</title>
    </head>
    <body>
        ログアウトしました。<br>
    </body>
    </html>