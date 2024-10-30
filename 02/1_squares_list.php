<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>1から10までの数字の二乗</h1>
    <table border="1">
        <thread>
            <tr>
                <td>数字</td>
                <td>二乗</td>
            </tr>
        </thread>
        <tbody>
            <tr>
                <?php
                for($i=1; $i<=10; $i++) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . ($i*$i) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tr>
        </tbody>
    </table>
</body>
</html>