<?php include "connect.php" ?>
<?php session_start(); ?>

<html>

<body>
    <h1>สวัสดี
        <?= $_SESSION["fullname"] ?>
    </h1>
    หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
    <?php
    if (empty($_SESSION["username"])) {
        header("location: login-form.php");
        exit();
    }

    if ($_SESSION["admin"]) {
        echo "<br><a href='product-list.php' style='margin-left:20px;' >ดูหน้าสินค้าคงเหลือ</a>";
        $stmt = $pdo->prepare(
            "SELECT member.username , count(orders.ord_id) total_order from member 
            LEFT JOIN orders on member.username = orders.username 
            GROUP BY member.username;"
        );
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            echo "
                <div>username : {$row["username"]} </div>
        
                    <div>จำนวนออเดอร์ : {$row["total_order"]} </div>
                    <a style='margin-left:20px;' href='order-list.php?username={$row['username']}'>ดูรายละเอียดออเดอร์</a>
              
            </div>
        ";
        }
        exit();
    }
    ?>

    <?php
    $stmt = $pdo->prepare(
        "SELECT orders.ord_id,ord_date,pname,pdetail,quantity,price from member 
        INNER JOIN orders ON member.username = orders.username 
        INNER JOIN item ON orders.ord_id = item.ord_id 
        INNER JOIN product ON item.pid = product.pid
        WHERE member.username = ? ORDER BY orders.ord_id ASC;"
    );

    $stmt->bindParam(1, $_SESSION["username"]);
    $stmt->execute();
    $numberorder = null;

    while ($row = $stmt->fetch()) {
        $sum_price = $row["price"] * $row["quantity"];
        if ($row["ord_id"] != $numberorder) {
            $numberorder = $row["ord_id"];
            echo "<h3>หมายเลขออเดอร์ : $numberorder </h3>";
            echo "<h5>วันที่ : {$row["ord_date"]} </h5>";
        }

        echo "ชื่อสินค้า: " . $row["pname"] . "<br>";
        echo "รายระเอียด: " . $row["pdetail"] . "<br>";
        echo "ราคา: " . $row["price"] . " บาท <br>";
        echo "จำนวนสินค้าที่สั่ง: " . $row["quantity"] . "<br>";
        echo "จำนวนราคารวมของสินค้าที่สั่ง: {$sum_price}" . "<br>";
        echo "<hr>\n";


    }


    ?>
</body>

</html>