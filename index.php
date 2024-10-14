<?php
	session_start();
	include_once("connectdb.php");

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน A</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .f1 {
            font-family: "Itim", cursive;
            font-weight: 500;
            color: #2F4F4F;
        }
        .f2 {
            font-family: "Itim", cursive;
            font-weight: 500;
            font-style: oblique;
            color: #FF5733;
        }
        input::placeholder {
            font-family: "Itim", cursive;
            color: #aaa;
            font-size: 14px;
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
    <main>
        <br><br><br><br>
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slide01.png" class="d-block w-100" alt="Description of image 1">
                </div>
                <div class="carousel-item">
                    <img src="images/slide02.png" class="d-block w-100" alt="Description of image 2">
                </div>
                <div class="carousel-item">
                    <img src="images/slide03.png" class="d-block w-100" alt="Description of image 3">
                </div>
                <div class="carousel-item">
                    <img src="images/slide04.png" class="d-block w-100" alt="Description of image 4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container marketing">
            <div class="row text-center">
                <?php
                // ดึงข้อมูลประเภทสินค้า
                $sql2 = "SELECT * FROM product_type";
                $rs2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) {
                    echo "<div class='col'>
                        <a href='index.php?pt={$data2['pt_id']}' class='text-decoration-none'>
                            <img src='images/{$data2['t_picture']}' class='rounded-circle' style='width: 120px; height: 120px;' alt='{$data2['pt_name']}'>
                            <h6 class='f1'>{$data2['pt_name']}</h6>
                        </a>
                    </div>";
                }
                ?>
            </div>
        </div>

        <?php
        @$kw = $_POST['kw'];
        @$pt = $_GET['pt'];
        $s = isset($pt) ? "AND (pt_id = '$pt')" : "";

        $sql = "SELECT * FROM product WHERE (p_name LIKE '%$kw%' OR p_detail LIKE '%$kw%') $s";
        $rs = mysqli_query($conn, $sql);
        $i = 0;

        echo '<div class="container mt-4">';

        echo '<div class="row">';

        while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
            $i++;
            if (($i - 1) % 4 === 0 && $i !== 1) {
                echo '</div><div class="row">';
            }
            ?>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card mb-4 shadow-sm w-100">
                    <a href="detail-index.php?id=<?=$data['p_id'];?>">
                        <img src="images/<?=$data['p_picture1'];?>" class="card-img-top" alt="<?=$data['p_name'];?>">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h6 class="f1"><?=$data['p_name'];?></h6>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h4><p class="f2"><?=number_format($data['p_price'], 0);?> บาท</p></h4>
                            <a href="basket.php?id=<?=$data['p_id'];?>" class="btn btn-light-blue"><i class="bi bi-cart4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }
        echo '</div>'; // ปิดแถวสุดท้าย
        echo '</div>'; // ปิด container

        mysqli_close($conn);
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </main>
</body>
</html>
