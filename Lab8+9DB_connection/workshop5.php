<?php include "connection.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <form>
        <input type="text" name="keyword">
        <input type="submit" value="ค้นหา">
    </form>
    <div style="display:flex">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ?");
        if (!empty($_GET)) // ถ ้ามีค่าที่สงมาจากฟอร์ม ่
            $value = '%' . $_GET["keyword"] . '%'; // ดึงค่าที่สงมาก าหนดให ้กับตัวแปรเงื่อนไข ่
        $stmt->bindParam(1, $value); // ก าหนดชอตัวแปรเงื่อนไขที่จุดที่ก าหนด ื่ ? ไว ้
        $stmt->execute(); // เริ่มค ้นหา
        ?>
        <?php while ($row = $stmt->fetch()): ?>
            <div style="padding: 15px; text-align: center">
            <a href="workshop5.1.php?username=<?=$row["username"]?>">
                <img src='./member_photo/<?= $row["username"] ?>.jpg' width='100'><br>
                </a><br>
                <?= $row["name"]  ?><br>
                <?= $row["address"] ?><br>
                <?= $row["email"] ?><br>
                
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>