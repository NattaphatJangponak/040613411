<?php
include "connect.php";
session_start();
// ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
if (    ) {
    header("location: login-form.php");
    exit(); 
}
?>
<html>
<body>
<h1>สินค้าที่สั่งของ <?=$_GET["username"]?></h1>

<?php
$stmt = $pdo->prepare(
    "SELECT orders.ord_id,ord_date,pname,pdetail,quantity,price from member 
        INNER JOIN orders ON member.username = orders.username 
        INNER JOIN item ON orders.ord_id = item.ord_id 
        INNER JOIN product ON item.pid = product.pid
        WHERE member.username = ? ORDER BY orders.ord_id ASC;"
);
$stmt->bindParam(1, $_GET["username"]);
$stmt->execute();
$num_order = null;

if ($stmt->rowCount() == 0) {
    echo 'ลูกค้าไม่มีรายการ (order)';
}

while ($row = $stmt->fetch()) {
    $sum_price = $row["price"] * $row["quantity"];
    if ($row["ord_id"] != $num_order) {
        $num_order = $row["ord_id"];
        echo "<h3>หมายเลขออเดอร์ : $num_order </h3>";
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