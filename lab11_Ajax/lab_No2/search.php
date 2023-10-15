<?php include "connection.php" ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
if (!empty($_GET)) // ถ ้ามีค่าที่สงมาจากฟอร์ม ่
$value = '%' . $_GET["username"] . '%'; // ดึงค่าที่สงมาก าหนดให ้กับตัวแปรเงื่อนไข ่
$stmt->bindParam(1,$value); // ก าหนดชอตัวแปรเงื่อนไขที่จุดที่ก าหนด ื่ ? ไว ้
$stmt->execute(); // เริ่มค ้นหา
 
?>
    <?php while ($row = $stmt->fetch()): ?>
 
    <div style="padding: 15px; text-align: center">
        <img src='./member_photo/<?= $row["username"] ?>.jpg' width='100'><br>
        <?= $row["name"] ?><br>
        <?= $row["address"] ?><br>
        <?= $row["email"] ?><br>
    </div>
  
<?php endwhile; ?>

<?php  ?>
 
 <div style="padding: 15px; text-align: center">
 <?php while ($row = $stmt->fetch()): ?>
     <?php
         echo  "<img src='./member_photo/".$row["username"].".jpg' width='100'><br>" ;
         echo "Name:".$row["name"]."<br>";
         echo "Address:".$row["address"]."<br>";
         echo "Email:".$row["email"]."<br>";
         ?>
     <?php endwhile; ?>
 </div>

<?php ?>