<?php include "connection.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>


    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ชื่อสมาชิก : " . $row["name"] . "<br>";
        echo "ที่อยู่ : " . $row["address"] . "<br>";
        echo "อีเมล์: " . $row["email"] . "<br>";
        ?>
        <img src='./member_photo/<?= $row["username"] ?>.jpg' width='100'><br>
        <?php
        echo "<hr>\n";
    }
    ?>
</body>

</html>