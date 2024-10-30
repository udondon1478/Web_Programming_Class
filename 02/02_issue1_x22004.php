<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $items = [["name" => "ペン", "stock" => 23],
    ["name" => "ノート", "stock" => 5],
    ["name" => "消しゴム", "stock" => 78],
    ];

    $array_count = count($items);

    $array_keys = array_keys($items);
    ?>

    <h1>在庫管理システム</h1>
    <table border="1">
        <thread>
            <tr>
                <td>商品名</td>
                <td>在庫数</td>
            </tr>
        </thread>
        <tbody>
            <?php foreach ($items as $item); ?>
            <?php for ($i=0; $i < $array_count; $i++) {
                echo "<tr>";
                echo "<td>" . $items[$i]["name"] . "</td>";
                echo "<td>" . $items[$i]["stock"] . "</td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>