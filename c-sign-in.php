<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>sign_in</title>
<link rel="icon" href="images/Logo.png" type="image/x-icon">
<!--icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- ฟ้อนต์ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            @media (min-width: 992px) {
            .form-signin {
                width: 100%; 
            }
        }
</style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
    <div class="container text-center">
        <main class="form-signin w-50 m-auto">
            <form method="POST" action="">
                <img class="mb-3" src="images/Logo.png" alt="" width="50%" height="50%">
                <h1 class="h5 mb-3 fw-normal"><span class="f1">Please sign in</span></h1>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cemail" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput"><span class="f1">Email address</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword"><span class="f1">Password</span></label>
                </div>
               
                <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span class="f1">Sign in</span></button>
            </form>
            <br>
            <div class="text-center">
                <h1 class="h5 mb-3 fw-normal"><span class="f1">ยังไม่มีสมาชิก/<a href="reg.php">สมัครสมาชิก</a></span></h1>
            </div>
        </main>
    </div>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start(); // เริ่มต้นเซสชัน
    include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

    if (isset($_POST['Submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['cemail']);
        $password = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $sql = "SELECT * FROM customer WHERE c_email = '$email'";
        $rs = mysqli_query($conn, $sql);
        
        if ($rs && mysqli_num_rows($rs) > 0) {
            $data = mysqli_fetch_array($rs);

            if ($data['c_password'] === ($password)) {
                $_SESSION['cid'] = $data['c_id'];
                $_SESSION['cfullname'] = $data['c_fullname'];
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('รหัสผ่านไม่ถูกต้อง');</script>";
            }
        } else {
            echo "<script>alert('อีเมลไม่ถูกต้อง');</script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
