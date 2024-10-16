<?php
include_once("r-checklogin.php");
include_once("connectdb.php");
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ร้านเขียนฝัน</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

<script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <style>
    body {
	background-color: #AFEEEE; /* สีพื้นหลังของทั้งหน้า */
    }
    .f1 {
        font-family: "Itim", cursive;
        font-weight: 500;
       
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
        background-color: #90caf9; /* สีพื้นหลังของปุ่ม */
        color: black;
        border: none;
    }
    .btn-light-blue:hover {
        background-color: #ff4081; /* สีพื้นหลังเมื่อวางเมาส์ */
        color: white;
    }
    .navbar {
	background-color: #48D1CC; /* สีพื้นหลังของ Navbar */
    }
    .navbar .nav-link {
        color: #20c997;
        width: 100%;
    }
    </style>
</head>
<body>

<header data-bs-theme="#8470FF">
    <div class="collapse text-bg-#8470FF" id="navbarHeader" style="background-color:#48D1CC;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="f1">About</h4>
                    <p class="text-body-secondary f1">อุปกรณ์เครื่องเขียนสุดน่ารัก</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4" >
                    <h4 class="f1">ผู้ดูแลระบบ</h4>
                    <ul class="list-unstyled f1">
                        <li class="f1"><?= $_SESSION['aname'];?></li>
                        <li><a href="r-logout.php" class="text-dark">ออกจากระบบ</a></li>
                        <li><a href="a-product.php" class="text-dark">จัดการข้อมูลสินค้า</a></li>
                        <li><a href="a-managecustomer.php" class="text-dark">จัดการข้อมูลลูกค้า</a></li>
                        <li><a href="a-manageorder.php" class="text-dark">จัดการข้อมูลออเดอร์ลูกค้า</a></li>
                         <li><a href="a-type.php" class="text-dark">จัดการข้อมูลประเภทสินค้า</a></li>
                         <li><a href="a-contact.php" class="text-dark">ข้อความจากลูกค้า</a></li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-#66CCFF bg-#66CCFF shadow-sm">
        <div class="container">
            <a href="a-home.php" class="navbar-brand d-flex align-items-center f1">
                <strong class="f1">ร้านเขียนฝัน   <i class="bi bi-pencil-fill"></i></strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
      </div>
  </div>
</header>

<main>
    <section class="py-5 text-center container-fluid">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light f1">ร้านเขียนฝัน</h1>
                <p class="lead text-body-secondary f1">เมื่อความคิดสร้างสรรค์บรรเจิด เครื่องเขียนที่นี่ช่วยได้</p>
                <p>
                    <a href="a-insert.php" class="btn btn-success my-2 f1">เพิ่มสินค้าใหม่</a>
                    <a href="r-logout.php" class="btn btn-danger my-2 f1">ออกจากระบบ</a>
                </p>
            </div>
        </div>
    </section>

    <div class="container-fluid border rounded-3 p-4 f1">
    <h2 class="mb-4"><span class="f1">รายการสินค้า</span></h2>
        <table id="myTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th class="f1">แก้ไข</th>
                    <th class="f1">ลบ</th>
                    <th class="f1">Picture</th>
                     <th class="f1">รหัสสินค้า</th>
                    <th class="f1">ชื่อสินค้า</th>
                    <th class="f1">รายละเอียดสินค้า</th>
                    <th class="f1">ราคา</th>
                    <th class="f1">ประเภทสินค้า</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $search = isset($_POST['search']) ? $_POST['search'] : '';
            $sql = "SELECT * FROM product AS p
                    LEFT JOIN product_type AS pt ON p.pt_id = pt.pt_id";

            if ($search) {
                $sql .= " WHERE p.p_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
            }
            $sql .= " ORDER BY p.p_id ASC";
            $rs = mysqli_query($conn, $sql);

            while ($data = mysqli_fetch_array($rs)) {
            ?>
                <tr>
                    <td>
                        <a href="a-update.php?pid=<?= $data['p_id'];?>" class="btn btn-warning btn-sm f1">
                            <i class="bi bi-pencil"></i> แก้ไข
                        </a>
                    </td>
                    <td>
                    <a href="a-delete.php?pid=<?= $data['p_id'];?>" onClick="return confirm('ยืนยันการลบ');" class="btn btn-danger btn-sm f1"><i class="bi bi-trash"></i> ลบ</a>


                    </td>
                    <td>
                        <img src="images/<?= $data['p_picture1'];?>?<?= time();?>" width="100%" class="img-thumbnail">
                        <img src="images/<?= $data['p_picture2'];?>?<?= time();?>" width="100%" class="img-thumbnail">
                        <img src="images/<?= $data['p_picture3'];?>?<?= time();?>" width="100%" class="img-thumbnail">
                        <img src="images/<?= $data['p_picture4'];?>?<?= time();?>" width="100%" class="img-thumbnail">
                    </td>
                    <td class="f1"><?= $data['p_id'];?></td>
                    <td class="f1"><?= $data['p_name'];?></td>
                    <td class="f1"><?= $data['p_detail'];?></td>
                    <td class="f1"><?= $data['p_price'];?></td>
                    <td class="f1"><?= $data['pt_name'];?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
