<?php  include_once("r-checklogin.php");?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>หน้าหลัก- แอดมิน</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .f1 {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
        .form-home {
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
        width: 300px; 
        height: 50px; 
        display: block; 
        margin: 10px auto; 
        font-size: 18px; 
    }
        .btn-light-blue {
            background-color: #b4daf4;
            color: black;
            border: none;
        }
        .btn-light-blue:hover {
            background-color: #ff99cc;
            color: white;
        }

        
        .btn-light-green {
            background-color: #98FB98;
            color: black;
            border: none;
        }
        .btn-light-green:hover {
            background-color: #00FF7F;
            color: white;
        }
		
		.btn-light-purple {
            background-color: #DDA0DD;
            color: black;
            border: none;
        }
        .btn-light-purple:hover {
            background-color: #D8BFD8;
            color: white;
        }
        .btn-light-orange {
            background-color: #FFCC33;
            color: black;
            border: none;
        }
        .btn-light-orange:hover {
            background-color: #FFFF33;
            color: white;
        }
        .btn-light-pink {
            background-color: #FF6666;
            color: black;
            border: none;
        }
        .btn-light-pink:hover {
            background-color: #FFCCCC;
            color: white;
        }

        body, html {
            height: 100vh; 
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa; 
        }
        .container {
            max-width: 600px; 
            width: 100%; 
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <main class="form-home">
            <a href="index.php">
                <img class="mb-3" src="images/Logo.png" style="max-width: 100%; height: auto;">
            </a>
            <h1 class="h5 mb-3 fw-normal"><span class="f1">ยินดีต้อนรับ</span></h1>
            <div class="container my-5">
                <a href="a-product.php" class="btn btn-light-purple f1"><i class="bi bi-arrow-left-circle"></i> จัดการข้อมูลสินค้า</a>
                <a href="a-managecustomer.php" class="btn btn-light-blue f1"><i class="bi bi-arrow-left-circle"></i> จัดการข้อมูลลูกค้า</a>
                <a href="a-manageorder.php" class="btn btn-light-green f1"><i class="bi bi-trash"></i> จัดการออเดอร์ลูกค้า</a>
                <a href="a-type.php" class="btn btn-light-pink f1"><i class="bi bi-trash"></i> จัดการประเภทสินค้า</a>
                <a href="a-contact.php" class="btn btn-light-orange f1"><i class="bi bi-trash"></i> ข้อความจากลูกค้า</a>
            </div>
        </main>
    </div>
</body>

        </main>
    </div>
</body>
</html>
