<?php
    session_start();
    include_once("connectdb.php");
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin-ร้านเขียนฝัน</title>
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
    
        .form-signin {
            width: 100%;
        }
    }
        /* Adjustments for larger screens (desktops) */
        @media (min-width: 992px) {
            .form-signin {
                width: 50%; /* Set a specific width for desktops */
            }
        }
    </style>

</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2">
        <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
    </a>
    <div class="container text-center">
        <main class="form-signin m-auto" style="max-width: 500px;">
            <form method="POST" action="">
                <img class="mb-3 img-fluid" src="images/Logo.png" alt="Logo" style="max-width: 100%; height: auto;">
                <h1 class="h5 mb-3 fw-normal"><span class="f1">Admin-ร้านเขียนฝัน</span></h1>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="ausername" placeholder="Username" autofocus required>
                    <label for="floatingInput"><span class="f1">Username</span></label>
                </div>

                <div class="form-floating mb-2">
                    <input type="password" class="form-control" name="apassword" placeholder="Password" required>
                    <label for="floatingPassword"><span class="f1">Password</span></label>
                </div>
            </form>
        </main>
    </div>
               
<button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span class="f1">Sign in</span></button>
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
