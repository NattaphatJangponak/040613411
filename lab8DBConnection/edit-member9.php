<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];

    $stmt = $pdo->prepare("UPDATE member SET username=?, password=?, name=?, address=?, mobile=?, email=? WHERE username=?");
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->bindParam(3, $name);
    $stmt->bindParam(4, $address);
    $stmt->bindParam(5, $mobile);
    $stmt->bindParam(6, $email);
    $stmt->bindParam(7, $username); // เพิ่มพารามิเตอร์สำหรับเงื่อนไข WHERE

    if ($stmt->execute()) { // เริ่มแก้ไขข้อมูล หากแก้ไขสำเร็จเงื่อนไขจะเป็นจริง
        echo "แก้ไขสมาชิก " . $_POST["username"] . " สำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล";
    }
}
?>