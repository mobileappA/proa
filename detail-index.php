<?php
 	session_start();
	include_once("connectdb.php");

?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<title>ดีเทล </title>
<link rel="icon" href="images/Logo.png" type="image/x-icon">
<!--icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!--ฟ้อน--><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet"><!--จบฟ้อน-->
<style> .f1 {
  font-family: "Itim", cursive;
  font-weight: 500;
  font-style: normal;
}
</style>
	<style>
        /* เปลี่ยนฟอนต์ของ placeholder */
        input::placeholder {
            font-family: "Itim", cursive; /* เปลี่ยนฟอนต์ที่นี่ */
            color: #aaa; /* เปลี่ยนสี */
            font-size: 14px; /* เปลี่ยนขนาด */
        }
    </style>
	<!--ฟ้อนราคาสินค้า-->
	<style> .f2 {
  font-family: "Itim", cursive;
  font-weight: 500;
  font-style:oblique;
  color: #FF5733;
}
</style>
	<!-- ใช้JavaScript เปลี่ยนรูป-->
<script>
    function changeImage(imageSrc) {
        document.getElementById('main-image').src = imageSrc;
    }
</script>

	<style>
    .btn-light-blue {
        background-color:#b4daf4; /* สีเขียวอ่อน */
        color: black; /* สีตัวอักษรเป็นสีดำ */
        border: none; /* ไม่มีกรอบ */
    }
    .btn-light-blue:hover {
        background-color: #ff99cc; /* สีชมพูเข้มเมื่อชี้เมาส์ */
        color: white; /* สีตัวอักษรเป็นสีขาวเมื่อชี้เมาส์ */
    }
/* เปลี่ยนสีพื้นหลังของ navbar เป็นสีฟ้า */
.navbar {
    background-color:#CCFFCC; /* สีเขียว */
}

/* เปลี่ยนสีตัวอักษรใน navbar เป็นสี */
.navbar .nav-link {
    color: #2F4F4F; /* สีตัวอักษร */
}


	</style>

 
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<style>
    .btn-light-blue {
        background-color:#b4daf4; /* สีชมพูอ่อน */
        color: black; /* สีตัวอักษรเป็นสีดำ */
        border: none; /* ไม่มีกรอบ */
    }
    .btn-light-blue:hover {
        background-color: #ff99cc; /* สีชมพูเข้มเมื่อชี้เมาส์ */
        color: white; /* สีตัวอักษรเป็นสีขาวเมื่อชี้เมาส์ */
    }
/* เปลี่ยนสีพื้นหลังของ navbar เป็นสีฟ้า */
.navbar {
    background-color:#CCFFCC; /* สีเขียว */
}

/* เปลี่ยนสีตัวอักษรใน navbar เป็นสี */
.navbar .nav-link {
    color: #2F4F4F; /* สีตัวอักษร */
}

/* เปลี่ยนสีปุ่มค้นหา */
.navbar .btn-outline-secondary {
    color: #2F4F4F; /* สีตัวอักษร */
    background-color: #ffffff; /* สีพื้นหลัง */
    border-color: #2E8B57; /* สีกรอบ */
}

.navbar .btn-outline-secondary:hover {
    background-color: #87CEFA; /* สีเมื่อ hover */
    border-color: #87CEFA; /* สีกรอบเมื่อ hover */
}
	</style>	
	
<body>
<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-light py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.php">
                <img src="images/Logo.png" alt="site icon" style="width: 40px; height: 40px;">
                <span class="f1" style="margin-left: 20px;">เขียนฝัน</span>
            </a>

            <div class="order-lg-2 nav-btns d-flex align-items-center ms-auto">
                <form class="form-inline d-flex" action="index.php" method="post">
                    <input name="kw" type="text" class="form-control me-2 f1" placeholder="ค้นหา..." style="width: 200px;">
                </form>
                <a href="basket.php" class="btn position-relative ms-2">
                    <img src="images/Shopping.png" alt="Shopping Cart" style="width: 40px; height: 40px;">
                </a>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/people.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow">
    			<?php if (isset($_SESSION['cid'])): ?>
    <li><a class="dropdown-item" href="profile.php?cid=<?php echo $_SESSION['cid']; ?>"><span class="f1">บัญชี</span></a></li>
    <li><a class="dropdown-item" href="c-update.php?cid=<?php echo $_SESSION['cid']; ?>"><span class="f1">ตั้งค่าบัญชี</span></a></li>
    <li><a class="dropdown-item" href="c-orderhistory.php?cid=<?php echo $_SESSION['cid']; ?>"><span class="f1">ดูประวัติการซื้อ</span></a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="c-logout.php"><span class="f1">Sign out</span></a></li>
<?php else: ?>
    <li><a class="dropdown-item" href="c-sign-in.php"><span class="f1">ลงชื่อเข้าใช้</span></a></li>
<?php endif; ?>

					</ul>

                </div>
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase" href="index.php"><h5><span class="f1">หน้าหลัก</span></h5></a>
                    </li>

                    <li class="nav-item px-2 py-2">
                        <div class="btn-group">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                                <h5><span class="f1">หมวดหมู่</span></h5>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                // ดึงข้อมูลจากฐานข้อมูลประเภทสินค้า
                                $sql2 = "SELECT * FROM product_type";
                                $rs2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($rs2) > 0) {
                                    while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) {
                                        echo "<li><a class='dropdown-item' href='index.php?pt={$data2['pt_id']}'><h6 class='f1'>{$data2['pt_name']}</h6></a></li>";
										
                                    }
                                } else {
                                    echo "<li><a class='dropdown-item' href='#'>ไม่มีหมวดหมู่</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase" href="contact.php"><h5><span class="f1">ติดต่อเรา</span></h5></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

<br>
<br>
<br>
<br>
<?php
// รับข้อมูลจาก id
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT * FROM product 
        WHERE p_id = $product_id"; 
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
	
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <!-- แสดงรูปภาพสินค้าหลัก -->
            <?php if ($data) { ?>
                <div class="text-center mb-3">
                    <img id="main-image" src="images/<?php echo htmlspecialchars($data['p_picture1']); ?>" alt="<?php echo htmlspecialchars($data['p_name']); ?>" class="img-fluid border border-secondary" style="border-width: 5px;">
                </div>
            <?php } ?>
            
            <!-- แสดงรูปภาพเพิ่มเติมจาก pt_detail ถ้ามี -->
            <div class="d-flex flex-wrap mt-3">
                <?php 
                // ค้นหารูปภาพที่เริ่มต้นด้วย p_id ที่มีนามสกุลเป็น jpg, png, gif
                $product_id = $data['p_id'];
                $image_files = array_merge(
                    glob("images/{$product_id}.*.jpg"),
                    glob("images/{$product_id}.*.png"),
                    glob("images/{$product_id}.*.gif")
                );

                if (!empty($image_files)) {
                    foreach ($image_files as $image_file) {
                        // แสดงรูปภาพเพิ่มเติม
                        echo "<a href='javascript:void(0);' onclick='changeImage(\"" . htmlspecialchars($image_file) . "\")'>
                                <img src='" . htmlspecialchars($image_file) . "' alt='รายละเอียดเพิ่มเติมของ " . htmlspecialchars($data['p_name']) . "' class='img-fluid border border-secondary' style='border-width: 5px; margin-right: 10px; width: 50px; height: 50px;'>
                              </a>";
                    }
                }
                ?>
            </div>
        </div><!--ดีเทลสินค้า-->
        <div class="col-md-8">
            <?php if ($data) { ?>
                <h2 class="f1"><?php echo htmlspecialchars($data['p_name']); ?></h2>
                <p class="f1"><?php echo nl2br(htmlspecialchars($data['p_detail'])); ?></p>

                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="f2 mb-0"><?= number_format($data['p_price'], 0); ?> บาท</h4>
                    <a href="basket.php?id=<?= $product_id; ?>" class="btn btn-light-blue">
                        <i class="bi bi-cart4"></i><span class="f1">หยิบลงตะกร้า</span>
                    </a>
                </div>
            <?php } else { ?>
                <p>ไม่พบสินค้านี้</p>
            <?php } ?>
        </div>
    </div>
</div>
	
<?php
mysqli_close($conn);
?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>