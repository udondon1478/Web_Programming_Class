<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $items = [["name" => "ペン", "category" => "文房具", "stock" => 23],
    ["name" => "ノート", "category" => "文房具", "stock" => 5],
    ["name" => "消しゴム", "category" => "文房具", "stock" => 78],
    ["name" => "パソコン", "category" => "電化製品", "stock" => 2],
    ["name" => "マウス", "category" => "電化製品", "stock" => 14],
    ["name" => "イヤホン", "category" => "電化製品", "stock" => 33],
    ["name" => "椅子", "category" => "家具", "stock" => 8],
    ["name" => "机", "category" => "家具", "stock" => 4],
    ];

    $array_count = count($items);

    $stationery_stock = 0;
    $electricity_stock = 0;
    $furniture_stock = 0;
    ?>

    <h1>在庫管理システム</h1>
    <table border="1">
        <thread>
            <tr>
                <td>商品名</td>
                <td>カテゴリ</td>
                <td>在庫数</td>
                <td>評価コメント</td>
            </tr>
        </thread>
        <tbody>
            <?php foreach ($items as $item); ?>
            <?php for ($i=0; $i < $array_count; $i++) {
                echo "<tr>";
                echo "<td>" . $items[$i]["name"] . "</td>";
                echo "<td>" . $items[$i]["category"] . "</td>";
                if ($items[$i]["stock"] < 10) {
                    echo '<td style = "color: red;">' . $items[$i]["stock"] . "</td>";
                }else {
                    echo "<td>" . $items[$i]["stock"] . "</td>";
                }

                if ($items[$i]["stock"] < 10) {
                    echo "<td>" . "在庫が少ないです!" . "</td>";
                }else if ($items[$i]["stock"] > 10 && $items[$i]["stock"] <= 50) {
                    echo "<td>" . "在庫数が適正です" . "</td>";
                }else if ($items[$i]["stock"] > 50) {
                    echo "<td>" . "在庫が多いです!" . "</td>";
                }

                
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
    
    <h2>カテゴリ別 在庫合計</h2>
    <?php for ($i=0; $i < $array_count; $i++) {
        if ($items[$i]["category"] == "文房具"){
            $stationery_stock += $items[$i]["stock"];
        }else if ($items[$i]["category"] == "電化製品") {
            $electricity_stock += $items[$i]["stock"];
        }else if ($items[$i]["category"] == "家具") {
            $furniture_stock += $items[$i]["stock"];
        }
    }

    echo "<ul>";
    echo "<li>" . "文房具 : " . "$stationery_stock" . "</li>";
    echo "<li>" . "電化製品 : " . "$electricity_stock" . "</li>";
    echo "<li>" . "家具 : " . "$furniture_stock" . "</li>";
    echo "</ul>";
    ?>
</body>
</html>