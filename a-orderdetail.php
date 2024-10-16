
<?php  include_once("r-checklogin.php");?>
<!doctype html>
<html lang="th"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำสั่งซื้อ</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- เชื่อมต่อกับฟ้อนต์ Google -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .fixed-column {
            width: 15%;
        }
		
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

        body {
            background-color: #f8f9fa; /* อาจจะเปลี่ยนสีพื้นหลัง */
        }
    </style>
	
</head>

<body>
<a href="a-manageorder.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
    <div class="container my-5">
		<h1 class="text-center"><span class="f1">หมายเลขคำสั่งซื้อ<?=$_GET['a'];?></span></h1>
        <table class="table table-info table-striped table-hover mt-4">
            <thead class="table-danger">
                <tr>
					<th scope="col" class="text-center"><h5 class="f1">ที่</h5></th>
					<th scope="col"><h5 class="f1">สินค้า</h5></th>
					<th scope="col" class="fixed-column text-center"><h5 class="f1">จำนวน</h5></th>
					<th scope="col" class="fixed-column text-center"><h5 class="f1">ราคา/ชิ้น (บาท)</h5></th>
					<th scope="col" class="fixed-column text-center"><h5 class="f1">รวม (บาท)</h5></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connectdb.php");
                $sql = "SELECT * FROM orders_detail
                INNER JOIN product ON orders_detail.pid = product.p_id
                WHERE orders_detail.oid = '".$_GET['a']."'";
                $rs = mysqli_query($conn, $sql);
                $i = 0;
                $total = 0; // เริ่มต้น total ก่อนลูป
                while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                    $i++;
                    $sum = $data['p_price'] * $data['item'];
                    $total += $sum; // คำนวณยอดรวม
                ?>
                <tr>
                    <th scope="row"><h5 class="f1"><?=$i;?></h5></th>
                    <td>
                        <img src="images/<?=$data['p_picture1'];?>" width="20%" class="img-thumbnail"><br>
                        <h5 class="f1"><?=@$data['p_name'];?></h5>
                    </td>
                    <td class="text-center"><h5 class="f1"><?=$data['item'];?></h5></td>
                    <td class="text-center"><h5 class="f1"><?=number_format($data['p_price'], 0);?></h5></td>
                    <td class="text-center"><h5 class="f1"><?=number_format($sum, 0);?></h5></td>
                </tr>
                <?php } ?>

                <?php
                // คำนวณส่วนลดและยอดรวมสุทธิ
                if ($total >= 500 && $total < 1000) {
                    $num= '20%';
                    $discount = $total * 0.2;
                } elseif ($total >= 1000 && $total < 2000) {
                    $num= '30%';
                    $discount = $total * 0.3;
                } elseif ($total >= 2000) {
                    $num= '40%';
                    $discount = $total * 0.4;
                } else {
                    $num= '0%';
                    $discount = 0;
                }
                $net_total = $total - $discount;
                ?>
                
                <tr class="table-warning">
                    <td colspan="4" class="text-end f1"><strong>รวมทั้งสิ้น</strong></td>
                    <td class="text-center f1"><strong><?=number_format($total, 0);?></strong></td>
                </tr>
                <tr class="table-warning">
                    <td colspan="4" class="text-end f1"><strong>ส่วนลด </strong><strong><?=$num;?></strong></td>
                    <td class="text-center f1"><strong><?=number_format($discount, 0);?></strong></td>
                </tr>
                <tr class="table-warning">
                    <td colspan="4" class="text-end f1"><strong>รวมคำสั่งซื้อ</strong></td>
                    <td class="text-center f1"><strong><?=number_format($net_total, 0);?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-3ycu8tNHYRIg7H5Lax8CT+LmMLCZlmIbFlTQF8b0bPs3FME9eFxA1XXMlKWjUWtv" crossorigin="anonymous"></script>
</body>
</html>
