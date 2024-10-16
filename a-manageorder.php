<?php
include_once("r-checklogin.php");
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
    $('#myTable').DataTable({
        "order": [[0, "desc"]] // จัดเรียงจากมากไปน้อย
    });
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
        color: #20c997; /* สีข้อความใน Navbar */
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
                <div class="col-sm-4 offset-md-1 py-4">
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
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light f1">ร้านเขียนฝัน</h1>
                <p class="lead text-body-secondary f1">เมื่อความคิดสร้างสรรค์บรรเจิด เครื่องเขียนที่นี่ช่วยได้</p>
                <p>
                    <a href="a-home.php" class="btn btn-primary my-2 f1">หน้าหลัก</a>
                    <a href="r-logout.php" class="btn btn-danger my-2 f1">ออกจากระบบ</a>
                </p>
            </div>
        </div>
    </section>

    
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</main>

<div class="container border rounded-3 p-4 f1">
    <h2 class="mb-4"><span class="f1">order</span></h2>
    <table id="myTable" class="table table-striped table-hover f1">
        <thead class="table-success f1">
            <tr class="f1">
                <th class="f1">หมายเลขคำสั่งซื้อ</th>
                <th class="f1">ยอดรวม</th>
                <th class="f1">รหัสลูกค้า</th>
                <th class="f1">ชื่อ-สกุล</th>
                <th class="f1">ที่อยู่จัดส่ง</th>
                <th class="f1">เบอร์โทรศัพท์</th>
                <th class="f1">&nbsp;</th>
                <th class="f1">สถานะ</th>
            </tr>
        </thead>
        <tbody>
<?php
include("connectdb.php");
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT o.oid, o.ototal, c.c_id, c.c_fullname, o.c_address, c.c_phonnumber, o.status
        FROM customer c 
        JOIN orders o ON c.c_id = o.c_id ";

if ($search) {
    $sql .= " WHERE o.oid LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
}


$rs = mysqli_query($conn, $sql);


while ($data = mysqli_fetch_array($rs)) {
?>
    <tr class="f1">
        <td class="f1"><?=$data['oid'];?></td>
        <td class="f1"><?=$data['ototal'];?></td>
        <td class="f1"><?=$data['c_id'];?></td>
        <td class="f1"><?=$data['c_fullname'];?></td>
        <td class="f1"><?=$data['c_address'];?></td>
        <td class="f1"><?=$data['c_phonnumber'];?></td>
        <td class="f1"><p><a href="a-orderdetail.php?a=<?=$data['oid'];?>" class="btn btn-light-blue"><span class="f1">ดูรายละเอียด</span></a></p></td>
        <td class="f1">
        <form method="post" action="update_status.php">
    <input type="hidden" name="oid" value="<?=$data['oid'];?>">
    <select name="status" class="form-control f1" onchange="this.form.submit()">
        <option value="สั่งซื้อสอนค้าสำเร็จ" <?= $data['status'] == 'สั่งซื้อสินค้าสำเร็จ' ? 'selected' : ''; ?>>สั่งซื้อสอนค้าสำเร็จ</option>
        <option value="ผู้ขายกำลังเตรียมพัสดุ" <?= $data['status'] == 'ผู้ขายกำลังเตรียมพัสดุ' ? 'selected' : ''; ?>>ผู้ขายกำลังเตรียมพัสดุ</option>
        <option value="จัดส่งสำเร็จ" <?= $data['status'] == 'จัดส่งสำเร็จ' ? 'selected' : ''; ?>>จัดส่งสำเร็จ</option>
        <option value="จัดส่งไม่สำเร็จ" <?= $data['status'] == 'จัดส่งไม่สำเร็จ' ? 'selected' : ''; ?>>จัดส่งไม่สำเร็จ</option>
    </select>
</form>

        </td>
    </tr>
<?php
}
?>
        </tbody>
    </table>
</div>
</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
