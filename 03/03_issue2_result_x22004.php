<?php
function ageMessage($age)
{
    if ($age >= 20) {
        return "成年です。";
    } else {
        return "未成年です。";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./03_issue2_result_x22004.css">
</head>

<body>
    <contact-container>
        <result>
            <?php
            if ($_POST['age'] >= 18)
                $name1 = $_POST['name'];
            $name1 = htmlspecialchars($name1);
            $age1 = $_POST['age'];
            $age1 = htmlspecialchars($age1);
            echo '<div class="name">' . $name1 . "さんは" . ageMessage($age1) . "</div>";
            ?>
            <?php
            $email1 = $_POST['email'];
            $email1 = htmlspecialchars($email1);
            echo '<div class="email">' . "メールアドレス: " . $email1 . "</div>";
            ?>
            <?php
            if (isset($_POST['check'])) {
                echo '<div class="check">' . "お知らせメールをお送りします。 </div>";
            } else {
                echo '<div class="check">' . "お知らせメールをお送りしません。 </div>";
            }
            ?>
            <?php
            $subject1 = $_POST['subject'];
            $subject1 = htmlspecialchars($subject1);
            echo '<div class="subject">' . "件名: " . $subject1 . "</div>";
            ?>
            <?php
            $message1 = $_POST['message'];
            $message1 = htmlspecialchars($message1);
            echo '<div class="message">' . "お問い合わせ内容: " . $message1 . "</div>";
            ?>
            <?php
            $transaction_ID = $_POST['transaction_ID'];
            echo '<div class="transaction">' . "トランザクションID: " . $transaction_ID . "</div>";
            ?>
        </result>

    </contact-container>

</body>

</html>