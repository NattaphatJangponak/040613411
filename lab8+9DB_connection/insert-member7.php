<?php include "connection.php" ?>
<?php
 
$username = $_POST["username"];
$stmt = $pdo->prepare("INSERT INTO member VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $username );
$stmt->bindParam(2, $_POST["password"]);
$stmt->bindParam(3, $_POST["name"]);
$stmt->bindParam(4, $_POST["address"]);
$stmt->bindParam(5, $_POST["mobile"]);
$stmt->bindParam(6, $_POST["email"]);
$stmt->execute(); // เริ่มเพิ่มข้อมูล
// $pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มส าเร็จ
if($_FILES["image"]["tmp_name"]){
    $targetfile = './member_photo/'.$_POST["username"].'.jpg';
    $upload = move_uploaded_file($_FILES["image"]["tmp_name"],$targetfile);
 
}
 
 
?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
กรอกข้อมูลสมาชิกใหม่
    <?= $username  ?>
</body>

</html>