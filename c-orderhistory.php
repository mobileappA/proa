<?php
include_once("c-checklogin.php");

?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสั่งซื้อ</title>
    <!--icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- ฟ้อนต์ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	

    <style>
        .f1 {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
        
        .form-signin {
            background-color: #FFF8DC; /* เปลี่ยนสีพื้นหลังเป็นสีแดงอ่อน */
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #FFEFD5; /* กำหนดสีกรอบ */
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
        .navbar {
            background-color: #CCFFCC;
        }
        .navbar .nav-link {
            color: #2F4F4F;
        }
    </style>    
</head>

<body class="d-flex flex-column min-vh-100 ">
<a href="index.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
    <div class="container my-5">
        <h1 class="text-center mb-4"><span class="f1">ประวัติการสั่งซื้อ</span></h1>
        <div class="card mx-auto">
            <div class="card-body ">
                <?php
                include("connectdb.php");
               
                // ตรวจสอบว่ามี c_id ใน session หรือไม่
                if (isset($_SESSION['cid'])) {
                    $c_id = $_SESSION['cid']; // ดึง ID ลูกค้าจาก session
                    
                    
                    $c_id = mysqli_real_escape_string($conn, $c_id);

                    //ดึงข้อมูลสั่งซื้อ
                    $sql = "SELECT * FROM orders WHERE c_id = '$c_id' ORDER BY oid DESC";
                    $rs = mysqli_query($conn, $sql);
                    
                    // วนลูปแสดงผล
                    while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                ?>
                <div class="border rounded p-3 mb-3 form-signin">
                <p><strong><span class="f1">วันที่:</span></strong> <span class="f1"><?=$data['odate'];?></span></p>
                <p><strong><span class="f1">ราคารวม:</span></strong> <span class="f1"><?=number_format($data['ototal'], 0);?> บาท</span></p>
                <p><strong><span class="f1">เลขที่ใบสั่งซื้อ:</span></strong> <span class="f1"><?=$data['oid'];?></span></p>
                <p><strong><span class="f1">ที่อยู่จัดส่ง:</span></strong> <span class="f1"><?=$data['c_address'];?></span></p>
                <p><strong><span class="f1">สถานะออร์เดอร์:</span></strong> <span class="f1"><?=$data['status'];?></span></p>
                                
                    <p><a href="c-orderhistorydetail.php?a=<?=$data['oid'];?>" class="btn btn-light-blue"><span class="f1">ดูรายละเอียด</span></a></p>
                </div>
                <?php 
                    } 
                } else {
                    echo "<div class='alert alert-warning' role='alert'>ไม่พบข้อมูลลูกค้า กรุณาเข้าสู่ระบบ</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
