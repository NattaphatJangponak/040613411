<?php include "connection.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(username) { // ฟังก์ชนจะถูกเรียกถ้าผู้ใช ั คลิกที่ ้ link ลบ
            var ans = confirm("ต้องการลบผู้ใช้ " + username); // แสดงกล่องถามผู้ใช ้
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "delete6.php?username=" + username; // สงรหัสส ่ นค ้าไปให ้ไฟล์ ิ delete.php
        }
    </script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo "username : " . $row["username"] . "<br>";
        echo "password : " . $row["password"] . "<br>";
        echo "ชื่อ : " . $row["name"] . "<br>";
        echo "นามสกุล : " . $row["address"] . "<br>";
        echo "mobile : " . $row["mobile"] . "<br>";
        echo "email : " . $row["email"] . "<br>";
        echo "<a href='workshop9.php?username=" . $row["username"] . "'>แก้ไข</a> | ";
        $js_username = json_encode($row["username"]);
        echo "<a href='#' onclick='confirmDelete({$js_username})'>ลบ</a>";
        echo "<hr>\n";
    }
    ?>
</body>

</html>