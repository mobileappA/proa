<?php
error_reporting(E_NOTICE);

@session_start();
include("connectdb.php");
$sql = "select * from product where p_id='{$_GET['id']}' ";
$rs = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($rs);
$id = $_GET['id'];

if (isset($_GET['id'])) {
    $_SESSION['sid'][$id] = $data['p_id'];
    $_SESSION['sname'][$id] = $data['p_name'];
    $_SESSION['sprice'][$id] = $data['p_price'];
    $_SESSION['sdetail'][$id] = $data['p_detail'];
    $_SESSION['spicture'][$id] = $data['p_picture1'];
    @$_SESSION['sitem'][$id]++;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .f1 {
            font-family: "Itim", cursive;
            font-weight: 500;
            color: #2F4F4F;
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
		
		.btn-light-red {
            background-color: #FF9292;
            color: black;
            border: none;
        }
        .btn-light-red:hover {
            background-color: #FF4500;
            color: white;
        }
        .navbar {
            background-color: #CCFFCC;
        }
        .navbar .nav-link {
            color: #2F4F4F;
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
        .navbar {
            background-color: #CCFFCC;
        }
        .navbar .nav-link {
            color: #2F4F4F;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center"><span class="f1"><i class="bi bi-bag-heart"></i>ตะกร้าสินค้า ร้านเขียนฝัน</span></h1>
        <a href="index.php" class="btn btn-light-blue f1"><i class="bi bi-arrow-left-circle"></i>กลับไปเลือกสินค้า</a>
        <a href="clear.php" class="btn btn-light-red f1"><i class="bi bi-trash"></i>ลบสินค้าทั้งหมด</a>

        <?php if (empty($_SESSION['sid'])) { ?>
            <a href="#" class="btn btn-success f1" onClick="alert('กรุณาเลือกสินค้า');"><i class="bi bi-coin"></i>สั่งซื้อสินค้า</a>
        <?php } else { ?>
            <a href="c-confirm.php?cid=<?php echo $_SESSION['cid']; ?>" class="btn btn-light-green f1"><i class="bi bi-coin"></i>สั่งซื้อสินค้า</a>
        <?php } ?>

        <br><br>
        <table class="table table-striped table-hover">
            <thead class="table-info">
                <tr>
                    <th scope="col" class="text-center f1">ที่</th>
                    <th scope="col" class="f1">รูปสินค้า</th>
                    <th scope="col" class="f1">ชื่อสินค้า</th>
                    <th scope="col" class="f1">ราคา/ชิ้น</th>
                    <th scope="col" class="f1">จำนวน (ชิ้น)</th>
                    <th scope="col" class="f1">รวม</th>
                    <th scope="col" class="f1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($_SESSION['sid'])) {
                foreach ($_SESSION['sid'] as $pid) {
                    @$i++;
                    $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
                    @$total += $sum[$pid];

                    //ยอดรวมตั้งแต่ 500 บาทขึ้นไป ลด 20%
                    if($total >= 500 && $total < 1000) {
                        $num= '20%';
                        $discount = $total * 0.2;
                    }
                    //ยอดรวมตั้งแต่ 1000 บาทขึ้นไป ลด 30%
                    elseif($total >= 1000 && $total < 2000) {
                        $num= '30%';
                        $discount = $total * 0.3;
                    }
                    // ยอดรวมตั้งแต่ 2000 บาทขึ้นไป ลด 40%
                    elseif($total >= 2000) {
                        $num= '40%';
                        $discount = $total * 0.4;

                    }
                    // ถ้าไม่เข้าเงื่อนไขใด ไม่มีส่วนลด
                    else {
                        $num= '0%';
                        $discount = 0;
                        $net_total = $total;
                    }
                    $net_total = $total - $discount;
            ?>
                <tr>
                    <td class="text-center f1"><?=$i;?></td>
                    <td><img src="images/<?=$_SESSION['spicture'][$pid];?>" width="120" class="img-thumbnail"></td>
                    <td class="f1"><?=$_SESSION['sname'][$pid];?></td>
                    <td class="text-center f1"><?=number_format($_SESSION['sprice'][$pid], 0);?></td>
                    <td class="text-center f1"><?=$_SESSION['sitem'][$pid];?></td>
                    <td class="text-center f1"><?=number_format($sum[$pid], 0);?></td>
                     <td><a href="clear2.php?id=<?=$pid;?>" class="text-center btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
            <?php } ?>
            <tr class="table-warning">
            <td colspan="5" class="text-end f1"><strong>รวมทั้งสิ้น</strong></td>
            <td class="text-center f1"><strong><?=number_format($total, 0);?></strong></td>
            <td class="f1"><strong>บาท</strong></td>
        </tr>
        <tr class="table-warning">
            <td colspan="5" class="text-end f1"><strong>ส่วนลด </strong><strong><?=$num;?></strong></td>
            <td class="text-center f1"><strong><?=number_format($discount, 0);?></strong></td>
            <td class="f1"><strong>บาท</strong></td>
        </tr>
        <tr class="table-warning">
            <td colspan="5" class="text-end f1"><strong>รวมคำสั่งซื้อ</strong></td>
            <td class="text-center f1"><strong><?=number_format($net_total, 0);?></strong></td>
            <td class="f1"><strong>บาท</strong></td>
</tr>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="text-center f1">ไม่มีสินค้าในตะกร้า</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
