<?php
include_once("r-checklogin.php");
include_once("connectdb.php");

$cid = isset($_GET['cid']) ? $_GET['cid'] : null; // ตรวจสอบว่ามี pid ถูกส่งมาหรือไม่

$sql1 = "SELECT * FROM customer WHERE c_id='{$cid}'";
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน</title>
</head>
<style>
        body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* ให้ฟอร์มอยู่กลางจอ */
        }
    </style>
<body>
<center><h1>เขียนฝัน - แก้ไขข้อมูลลูกค้า</h1></center>
<br><br>

<form class="form-container" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">ชื่อลูกค้า</label>
            <div class="col-md-4">
                <input type="text" name="cfullname" style="width: 300px" required autofocus value="<?=$data1['c_fullname'];?>"><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">ที่อยู่1</label>
            <div class="col-md-4">
                <textarea name="caddress1" rows="5" cols="50"><?=$data1['c_address1'];?></textarea><br>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">ที่อยู่</label>
            <div class="col-md-4">
                <textarea name="caddress2" rows="5" cols="50"><?=$data1['c_address2'];?></textarea><br>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">ที่อยู่</label>
            <div class="col-md-4">
                <textarea name="caddress3" rows="5" cols="50"><?=$data1['c_address3'];?></textarea><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="number">เบอร์โทรศัพท์</label>
            <div class="col-md-4">
                <input type="number" name="cphonnumber" required value="<?=$data1['c_phonnumber'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
		<div class="form-group">
            <label class="col-md-4 control-label" for="text">อีเมล</label>
            <div class="col-md-4">
                <input type="text" name="cemail" required value="<?=$data1['c_email'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
		<div class="form-group">
            <label class="col-md-4 control-label" for="number">รหัสผ่าน</label>
            <div class="col-md-4">
                <input type="password" name="cpassword" required value="<?=$data1['c_password'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
        <br>

        
        <br>
			<br>

     
        <br><br>
        <button type="submit" name="Submit" class="btn btn-success center-block"> บันทึก </button>
    </fieldset>
</form>
<hr><hr>

<?php
    if (isset($_POST['Submit'])) {
        // รับค่าจากฟอร์ม
        $fullname = $_POST['cfullname'];
        $address1= $_POST['caddress1'];
        $address2= $_POST['caddress2'];
        $address3= $_POST['caddress3'];
        $phonnumber = $_POST['cphonnumber'];
        $email = $_POST['cemail'];
        $password = $_POST['cpassword'];

        // อัปเดตข้อมูลลูกค้าในฐานข้อมูล
        $sql = "UPDATE `customer` SET 
                    `c_fullname` = '$fullname', 
                    `c_address1` = '$address1', 
                    `c_address2` = '$address2', 
                    `c_address3` = '$address3', 
                    `c_phonnumber` = '$phonnumber', 
                    `c_email` = '$email',
                    `c_password` = '$password' 
                WHERE `c_id` = $cid";

        if (mysqli_query($conn, $sql)) {
            echo "<script>";
            echo "alert('อัปเดตข้อมูลบัญชีผู้ใช้สำเร็จ');";
            echo "window.location='a-managecustomer.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');";
            echo "</script>";
        }
    }

    mysqli_close($conn);
    ?>

</body>
</html>