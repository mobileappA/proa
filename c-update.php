<?php
include_once("c-checklogin.php");
include_once("connectdb.php");

// รับข้อมูลจาก id
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

if ($cid === 0) {
    echo "<script>alert('ID ลูกค้าไม่ถูกต้อง'); window.location='index.php';</script>";
    exit;
}

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$sql = "SELECT * FROM customer WHERE c_id = $cid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('ไม่พบข้อมูลลูกค้า'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าบัญชี</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>       
     body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
        .form-signin {
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary position-relative">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
    <div class="container text-center">
        <main class="form-signin w-50 m-auto">
            <form method="POST" action="">
                <img class="mb-3" src="images/Logo.png" alt="" width="50%" height="50%">
                <hr>
                <h1 class="h5 mb-3 fw-normal"><span class="f1">ตั้งค่าบัญชีผู้ใช้</span></h1>
                <hr>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cfullname" value="<?=$data['c_fullname'];?>" id="floatinName" placeholder="Name" required>
                    <label for="floatinName"><span class="f1">ชื่อ-สกุล</span></label>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="caddress1" value="<?=$data['c_address1'];?>" id="floatinAddress" placeholder="ที่อยู่" required>
                    <label for="floatinAddress"><span class="f1">ที่อยู่1</span></label>
                </div>
				
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="caddress2" value="<?=$data['c_address2'];?>" id="floatinAddress" placeholder="ที่อยู่" >
                    <label for="floatinAddress"><span class="f1">ที่อยู่2</span></label>
                </div>
				
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="caddress3" value="<?=$data['c_address3'];?>" id="floatinAddress" placeholder="ที่อยู่" >
                    <label for="floatinAddress"><span class="f1">ที่อยู่3</span></label>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cphonnumber" value="<?=$data['c_phonnumber'];?>" id="floatinPhoneNum" placeholder="เบอร์โทร" required>
                    <label for="floatinPhoneNum"><span class="f1">เบอร์โทร</span></label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" name="cemail" value="<?=$data['c_email'];?>" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput"><span class="f1">Email address</span></label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="cpassword" value="<?=$data['c_password'];?>"  id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword"><span class="f1">Password</span></label>
                </div>
               
                <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span class="f1">บันทึก</span></button>
            </form><br>
        </main>
    </div>

    <?php
    if (isset($_POST['Submit'])) {
        // รับค่าจากฟอร์ม
        $fullname = $_POST['cfullname'];
        $address1 = $_POST['caddress1'];
		 $address2 = $_POST['caddress2'];
		 $address3 = $_POST['caddress3'];
        $phonnumber = $_POST['cphonnumber'];
        $email = $_POST['cemail'];
        $password = $_POST['cpassword'];

        // อัปเดตข้อมูลลูกค้าในฐานข้อมูล
        $sql = "UPDATE `customer` SET 
                    `c_fullname` = '$fullname', 
                    `c_address1` = '$address1', 
					`c_address2` = '$address2', 
					`c_address3` = '$address3', 
                    `c_phonnumber` = '$phonnumber', 
                    `c_email` = '$email',
                    `c_password` = '$password' 
                WHERE `c_id` = $cid";

        if (mysqli_query($conn, $sql)) {
            echo "<script>";
            echo "alert('อัปเดตข้อมูลบัญชีผู้ใช้สำเร็จ');";
            echo "window.location='index.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');";
            echo "</script>";
        }
    }

    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
