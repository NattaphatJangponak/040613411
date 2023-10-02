<?php include "connection.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <table border='1'>
        <tr>
            <th>
                รหัสสินค้า
            </th>
            <th>
                ชื่อสินค้า
            </th>
            <th>
                รายละเอียด
            </th>
            <th>
                ราคา
            </th>
        </tr>
        <tr>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM product");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                ?>

            <tr>
                <td>
                    <?= $row["pid"] ?>
                </td>
                <td>
                    <?= $row["pname"] ?>
                </td>
                <td>
                    <?= $row["pdetail"] ?>
                </td>
                <td>
                    <?= $row["price"] ?> บาท
                </td>
            </tr>
            <?php
            }
            ?>
        </tr>
    </table>
</body>

</html>