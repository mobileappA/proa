<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มสมัครสมาชิก</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
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
            width: 100%;
            max-width: 400px; 
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
        }
  
        @media (min-width: 992px) {
            .form-signin {
                max-width: 50%; 
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2">
        <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
    </a>
    <div class="container text-center">
        <main class="form-signin m-auto shadow-lg p-4" style="max-width: 500px;">
            <form method="POST" action="">
                <br>
                <img class="mb-3 img-fluid" src="images/Logo.png" alt="" style="max-width: 100%; height: auto;">
                <hr>
                <h1 class="h5 mb-3 fw-normal">สมัครสมาชิก</h1>
                <hr>
                
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cfullname" id="floatinName" placeholder="Name" required>
                    <label for="floatinName">ชื่อ-สกุล</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="caddress" id="floatinAddress" placeholder="ที่อยู่" required>
                    <label for="floatinAddress">ที่อยู่</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="tel" class="form-control" name="cphonnumber" id="floatinPhoneNum" placeholder="เบอร์โทร" required>
                    <label for="floatinPhoneNum">เบอร์โทร</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="email" class="form-control" name="cemail" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">สมัครสมาชิก</button>
            </form><br>
        </main>
    </div>

    <?php
 
     include_once("connectdb.php");
 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // ทำการเข้ารหัสรหัสผ่าน
         $cpassword =($_POST['cpassword']);
 
         // เตรียมคิวรี
         $sqli = "INSERT INTO customer (c_fullname, c_address1, c_phonnumber, c_email, c_password) 
                 VALUES ('{$_POST['cfullname']}', '{$_POST['caddress']}', '{$_POST['cphonnumber']}', '{$_POST['cemail']}', '$cpassword')";
 
         // ตรวจสอบว่าคิวรีสำเร็จหรือไม่
         if (mysqli_query($conn, $sqli)) {
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
