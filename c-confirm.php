<?php

session_start();
include("connectdb.php");


if (empty($_SESSION['cid'])) {
    // ถ้าไม่มี c_id ในเซสชัน
    echo "<script>alert('กรุณาเข้าสู่ระบบเพื่อทำการสั่งซื้อ'); window.location.href='c-sign-in.php';</script>";
    exit;
}

$cid = $_SESSION['cid']; // กำหนดค่า $cid จากเซสชัน

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$sql = "SELECT * FROM customer WHERE c_id = $cid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('ไม่พบข้อมูลลูกค้า'); window.location='index.php';</script>";
    exit;
}
?>
<?php
// ก่อนที่จะเข้าสู่ HTML เช้คข้อมูลที่อยู่
$show_address1 = !empty($data['c_address1']);
$show_address2 = !empty($data['c_address2']);
$show_address3 = !empty($data['c_address3']);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันคำสั่งซื้อ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary position-relative">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
    <div class="container text-center">
        <main class="form-signin w-50 m-auto">
            <form method="POST" action=" ">

                <img class="mb-3" src="images/Logo.png" alt="" width="50%" height="50%">
                <hr>
                <h1 class="h5 mb-3 fw-normal"><span class="f1">ยืนยันการสั่งซื้อ</span></h1>
                <hr>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cfullname" value="<?=$data['c_fullname'];?>" id="floatinName" placeholder="Name" required readonly>
                    <label for="floatinName"><span class="f1">ชื่อ-สกุล</span></label>
                </div>

                <div class="form-floating mb-2 d-flex align-items-center">
    <?php if ($show_address1): ?>
        <input type="text" class="form-control" name="caddress1" value="<?= htmlspecialchars($data['c_address1']); ?>" id="floatinAddress1" placeholder="ที่อยู่" required readonly>
        <input type="radio" class="form-check-input ms-2" name="address" id="radioAddress1" value="1" <?php echo isset($data['c_address1']) ? 'checked' : ''; ?>>
        <label for="radioAddress1" class="ms-1"><span class="f1">ที่อยู่1</span></label>
    <?php endif; ?>
</div>

<div class="form-floating mb-2 d-flex align-items-center">
    <?php if ($show_address2): ?>
        <input type="text" class="form-control" name="caddress2" value="<?= htmlspecialchars($data['c_address2']); ?>" id="floatinAddress2" placeholder="ที่อยู่" readonly>
        <input type="radio" class="form-check-input ms-2" name="address" id="radioAddress2" value="2" <?php echo isset($data['c_address2']) ?  : ''; ?>>
        <label for="radioAddress2" class="ms-1"><span class="f1">ที่อยู่2</span></label>
    <?php endif; ?>
</div>
				<div class="form-floating mb-2 d-flex align-items-center">
    <?php if ($show_address3): ?>
        <input type="text" class="form-control" name="caddress2" value="<?= htmlspecialchars($data['c_address3']); ?>" id="floatinAddress3" placeholder="ที่อยู่" readonly>
        <input type="radio" class="form-check-input ms-2" name="address" id="radioAddress3" value="3" <?php echo isset($data['c_address3']) ? : ''; ?>>
        <label for="radioAddress3" class="ms-1"><span class="f1">ที่อยู่3</span></label>
    <?php endif; ?>
</div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="cphonnumber" value="<?=$data['c_phonnumber'];?>" id="floatinPhoneNum" placeholder="เบอร์โทร" required readonly>
                    <label for="floatinPhoneNum"><span class="f1">เบอร์โทร</span></label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span class="f1">ยืนยันการสั่งซื้อ</span></button>
            </form><br>
        </main>
    </div>

    <?php
if (isset($_POST['Submit'])) {
    $total = 0;
    foreach ($_SESSION['sid'] as $key => $pid) {
        $sum[$pid] = $_SESSION['sprice'][$key] * $_SESSION['sitem'][$key];
        $total += $sum[$pid];

        // คำนวณส่วนลดตามยอดรวม
        if ($total >= 500 && $total < 1000) {
            $num = '20%';
            $discount = $total * 0.2;
        } elseif ($total >= 1000 && $total < 2000) {
            $num = '30%';
            $discount = $total * 0.3;
        } elseif ($total >= 2000) {
            $num = '40%';
            $discount = $total * 0.4;
        } else {
            $num = '0%';
            $discount = 0;
        }
    }

    $net_total = $total - $discount;

    // ตรวจสอบค่าที่อยู่ที่ลูกค้าเลือก
    $selected_address = '';
    if ($_POST['address'] == '1') {
        $selected_address = $data['c_address1'];
    } elseif ($_POST['address'] == '2') {
        $selected_address = $data['c_address2'];
    } elseif ($_POST['address'] == '3') {
        $selected_address = $data['c_address3'];
    }

    echo "Selected Address: " . $selected_address;

	$sql = "insert into `orders` values('$net_total', CURRENT_TIMESTAMP, '{$_SESSION['cid']}','$selected_address','สั่งซื้อสินค้าสำเร็จ');" ;

// รันคำสั่ง SQL
mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Get last inserted order id
    $id = mysqli_insert_id($conn);

 foreach($_SESSION['sid'] as $pid) {
		$sql2 = "insert into orders_detail values('$id', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."');" ;
		mysqli_query($conn, $sql2);
		
    }

    echo "<meta http-equiv=\"refresh\" content=\"0;URL=clear.php\">";
}
?>
?>

</body>
</html>
