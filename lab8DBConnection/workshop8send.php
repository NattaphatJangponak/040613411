<?php
include "connection.php";

 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];

    $stmt = $pdo->prepare("INSERT INTO member (username, password, name, address, mobile, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->bindParam(3, $name);
    $stmt->bindParam(4, $address);
    $stmt->bindParam(5, $mobile);
    $stmt->bindParam(6, $email);
    $stmt->execute(); // เริ่มเพิ่มข้อมูล
    header("location: workshop6.php");
    // $pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มสำเร็จ
 
?>

<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    กรอกข้อมูลสมาชิกใหม่ <?= $username ?>
</body>

</html>