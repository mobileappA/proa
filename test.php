<?php
	include_once("../checklogin.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VETA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <script src="../assets/js/color-modes.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
	<style>
        body {
            background-color: #f8f9fa; /* พื้นหลังที่อ่อนนุ่ม */
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .container {
            margin-top: 100px;
            padding: 20px; /* เพิ่ม padding เพื่อไม่ให้เนื้อชิดขอบ */
            width: 100%; /* ทำให้ความกว้างเต็มหน้าจอ */
            max-width: 600px; /* กำหนดความกว้างสูงสุด */
            margin-left: auto; /* จัดกลาง */
            margin-right: auto; /* จัดกลาง */
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: bold;
        }
		.btn {
        font-size: 1rem; /* ขนาดตัวอักษร */
        padding: 8px; /* ขนาด padding */
        border-radius: 5px; /* มุมมน */
    }
	 .btn-primary, .btn-danger,  .btn-secondary {
        width: 100px;
        margin-right: 10px;
    }
	
		.btn-danger{
            background-color: #dc3545; /* สีแดง */
            border: none;
            font-size: 1.2rem; /* ปรับขนาดตัวอักษรของปุ่ม */
            display: block; /* ทำให้ปุ่มอยู่ตรงกลาง */
            margin: 0 auto; /* จัดกลาง */
        }
		 .btn-secondary {
        background-color: #6c757d; /* สีเทา */
        border: none; /* ไม่มีกรอบ */
		font-size: 1.2rem; /* ปรับขนาดตัวอักษรของปุ่ม */
            display: block; /* ทำให้ปุ่มอยู่ตรงกลาง */
            margin: 0 auto; /* จัดกลาง */
    }

        .btn-primary {
            background-color: #007bff; /* ปรับสีปุ่มหลัก */
            border: none;
            font-size: 1.2rem; /* ปรับขนาดตัวอักษรของปุ่ม */
            display: block; /* ทำให้ปุ่มอยู่ตรงกลาง */
            margin: 0 auto; /* จัดกลาง */
        }
.btn:hover {
        opacity: 0.9; /* ลดความโปร่งใสเมื่อ hover */
    }

	</style>
</head>
<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../product/indexproduct.php">VETA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" 
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../product/indexproduct.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../order/view_order.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../po1/user_list.php">Users</a>
                        </li>
                    </ul>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle" style="font-size: 32px;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end"> 
                            <li>
                                <a style="display: block; text-align: center;"><?=$_SESSION['aname'];?></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

<div class="container">
<h1>เพิ่มสินค้า</h1>

<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="pname" class="form-label">ชื่อสินค้า</label>
        <input type="text" name="pname" id="pname" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
        <label for="pdetail" class="form-label">รายละเอียดสินค้า</label>
        <textarea name="pdetail" id="pdetail" rows="3" class="form-control"></textarea> <!-- ลดขนาด textarea -->
    </div>

    <div class="mb-3">
        <label for="pprice" class="form-label">ราคา</label>
        <input type="text" name="pprice" id="pprice" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="pimg" class="form-label">รูปภาพ</label>
        <input type="file" name="pimg" id="pimg" class="form-control">
    </div>

    <div class="mb-3">
        <label for="pcat" class="form-label">ประเภทสินค้า</label>
        <select name="pcat" id="pcat" class="form-select">
            <?php	
            include_once("connectdb.php");
            $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC ";
            $rs2 = mysqli_query($conn, $sql2);
            while ($data2 = mysqli_fetch_array($rs2)) {
            ?>
                <option value="<?= $data2['pt_id']; ?>"><?= $data2['pt_name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <hr>

    <div class="mb-3 d-flex">
    <button type="submit" name="Submit" class="btn btn-primary flex-grow-1 me-2">
        <i class="bi bi-floppy"></i> เพิ่ม
    </button>
    
    <button type="reset" name="Reset" class="btn btn-danger flex-grow-1 me-2">
        <i class="bi bi-x-circle"></i> ยกเลิก
    </button>
    
    <a href="indexproduct.php" class="btn btn-secondary flex-grow-1">
        <i class="bi bi-arrow-left"></i> กลับ
    </a>
</div>
<?php   
include_once("connectdb.php");

if (isset($_POST['Submit'])) {
    // ตรวจสอบว่ามีการอัปโหลดไฟล์
    if (isset($_FILES['pimg']) && $_FILES['pimg']['error'] == UPLOAD_ERR_OK) {
        // ตรวจสอบประเภทของไฟล์ (อนุญาตเฉพาะรูปภาพ)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['pimg']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // ดึงนามสกุลไฟล์

        if (!in_array($ext, $allowed_types)) {
            die("ประเภทไฟล์ไม่ถูกต้อง กรุณาอัปโหลดไฟล์ JPG, JPEG, PNG, หรือ GIF เท่านั้น");
        }

        // ตรวจสอบขนาดของไฟล์ (ไม่เกิน 5MB)
        if ($_FILES['pimg']['size'] > 5000000) {
            die("ไฟล์มีขนาดใหญ่เกินไป กรุณาอัปโหลดไฟล์ที่มีขนาดไม่เกิน 5MB");
        }

        // สร้างชื่อไฟล์ใหม่เพื่อหลีกเลี่ยงการซ้ำกัน
        $new_file_name = uniqid() . '.' . $ext;

        // สร้าง SQL สำหรับเพิ่มข้อมูลสินค้าใหม่ลงในฐานข้อมูล
        $sql_insert = "INSERT INTO product (p_name, p_detail, p_price, p_picture, pt_id) 
                       VALUES (
                           '{$_POST['pname']}', 
                           '{$_POST['pdetail']}', 
                           '{$_POST['pprice']}', 
                           '{$new_file_name}', 
                           '{$_POST['pt']}'
                       );";
        
        if (mysqli_query($conn, $sql_insert)) {
            // รับ p_id ที่เพิ่งถูกสร้างใหม่
            $p_id = mysqli_insert_id($conn);

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการเก็บ
            if (move_uploaded_file($_FILES['pimg']['tmp_name'], "images/" . $new_file_name)) {
                echo "<script>";
                echo "alert('เพิ่มข้อมูลสินค้าสำเร็จ');";
                echo "window.location='indexproduct.php';";
                echo "</script>";
            } else {
                die("คัดลอกไฟล์ไม่สำเร็จ");
            }
        } else {
            die("เพิ่มข้อมูลสินค้าไม่ได้");
        }
    } else {
        die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
    }
}
?>

<?php	
	mysqli_close($conn);
?>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>