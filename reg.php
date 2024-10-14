<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มสมัครสมาชิก</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .f1 {
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
                <h1 class="h5 mb-3 fw-normal"><span class="f1">สมัครสมาชิก</span></h1>
                <hr>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cfullname" id="floatinName" placeholder="Name" required>
                    <label for="floatinName"><span class="f1">ชื่อ-สกุล</span></label>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="caddress" id="floatinAddress" placeholder="ที่อยู่" required>
                    <label for="floatinAddress"><span class="f1">ที่อยู่</span></label>
                </div>
                    
                <div class="form-floating mb-2">
                    <input type="tel" class="form-control" name="cphonnumber" id="floatinPhoneNum" placeholder="เบอร์โทร" required>
                    <label for="floatinPhoneNum"><span class="f1">เบอร์โทร</span></label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" name="cemail" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput"><span class="f1">Email address</span></label>
                </div>
                    
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword"><span class="f1">Password</span></label>
                </div>
               
                <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span class="f1">สมัครสมาชิก</span></button>
            </form><br>
        </main>
    </div>

    <?php
 
     include_once("connectdb.php");
 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // ทำการเข้ารหัสรหัสผ่าน
         $cfullname = mysqli_real_escape_string($conn, $_POST['cfullname']);
         $caddress = mysqli_real_escape_string($conn, $_POST['caddress']);
         $cphonnumber = mysqli_real_escape_string($conn, $_POST['cphonnumber']);
         $cemail = mysqli_real_escape_string($conn, $_POST['cemail']);
         $cpassword =($_POST['cpassword']);
 
         // เตรียมคิวรี
         $sql = "INSERT INTO customer (c_fullname, c_address1, c_phonnumber, c_email, c_password) 
                 VALUES ('$cfullname','$caddress,$cphonnumber','$cemail','$cpassword')";
 
         // ตรวจสอบว่าคิวรีสำเร็จหรือไม่
         if (mysqli_query($conn, $sql)) {
             echo "<script>alert('ยินดีต้อนรับสู่ร้านเขียนฝัน Please sign in'); window.location='c-sign-in.php';</script>";
         } else {
             echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
         }
     }
 
     mysqli_close($conn);
     ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
