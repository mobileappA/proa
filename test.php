<?php include_once("connectdb.php"); ?>

<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>สมัครสมาชิก</title>
    <style>
        body, h1, label, input, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <center><h1>สมัครสมาชิก</h1></center>

    <form class="form-horizontal" method="post" action="">
        <div class="form-group">
            <label class="col-md-4 control-label" for="cfullname">ชื่อ-นามสกุล</label>
            <div class="col-md-4">
                <input id="cfullname" name="cfullname" type="text" class="form-control input-md" required autofocus><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="caddress">ที่อยู่</label>
            <div class="col-md-4">
                <textarea id="caddress" name="caddress" class="form-control" required></textarea><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="cphonnumber">เบอร์โทรศัพท์</label>
            <div class="col-md-4">
                <input id="cphonnumber" name="cphonnumber" type="text" class="form-control input-md" required><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="cemail">อีเมล</label>
            <div class="col-md-4">
                <input id="cemail" name="cemail" type="email" class="form-control input-md" required><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="cpassword">รหัสผ่าน</label>
            <div class="col-md-4">
                <input id="cpassword" name="cpassword" type="password" class="form-control input-md" required><br>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" name="Submit" class="btn btn-success">สมัครสมาชิก</button>
            </div>
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ตรวจสอบว่าข้อมูลฟอร์มมีการส่งมาหรือไม่
        if (isset($_POST['cfullname'], $_POST['caddress'], $_POST['cphonnumber'], $_POST['cemail'], $_POST['cpassword'])) {
            // เก็บข้อมูลที่ส่งมาจากฟอร์ม
            $cfullname = $_POST['cfullname'];
            $caddress = $_POST['caddress'];
            $cphonnumber = $_POST['cphonnumber'];
            $cemail = $_POST['cemail'];
            $cpassword = password_hash($_POST['cpassword'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่านด้วย bcrypt

            // เตรียมคำสั่ง SQL
            $sql = "INSERT INTO member (c_fullname, c_address1, c_phonnumber, c_email, c_password) 
                    VALUES (?, ?, ?, ?, ?)";
            
            // เตรียม statement
            $stmt = mysqli_prepare($conn, $sql);

            // ผูกตัวแปร
            mysqli_stmt_bind_param($stmt, "sssss", $cfullname, $caddress, $cphonnumber, $cemail, $cpassword);

            // ตรวจสอบว่าคำสั่งสำเร็จหรือไม่
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('สมัครสมาชิกเรียบร้อยแล้ว'); window.location='login_page.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_stmt_error($stmt) . "');</script>";
            }

            // ปิด statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        mysqli_close($conn);
    }
    ?>
</body>
</html>
