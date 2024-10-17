<?php
    session_start();
    include_once("connectdb.php");
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin-ร้านเขียนฝัน</title>
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
            width: 100%;
        }
        .shadow-lg {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);/* เพิ่มความโค้งมนให้กับฟอร์ม */
        }

        .form-signin {
            border-radius: 10px;
        }
        @media (min-width: 992px) {
            .form-signin {
                width: 50%; 
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
                <img class="mb-3 img-fluid" src="images/Logo.png" alt="Logo" style="max-width: 100%; height: auto;">
                <h1 class="h5 mb-3 fw-normal">Admin-ร้านเขียนฝัน</h1>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="ausername" placeholder="Username" autofocus required>
                    <label for="floatingInput">Username</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="password" class="form-control" name="apassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit" name="Submit">Sign in</button>
            </form>
        </main>
    </div>
               

<?php
if (isset($_POST['Submit'])) {
    $sql = "SELECT * FROM admin WHERE a_username = '{$_POST['ausername']}' AND a_password = '".md5($_POST['apassword'])."'";
    $rs = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($rs);

    if ($num > 0) {
        $data = mysqli_fetch_array($rs);
        $_SESSION['aid'] = $data['a_id'];
        $_SESSION['aname'] = $data['a_name'];
        echo "<script>window.location='a-home.php';</script>";
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
        exit;
    }
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
