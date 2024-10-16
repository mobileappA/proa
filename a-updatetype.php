<?php
include_once("r-checklogin.php");
include_once("connectdb.php");

$pt_id = isset($_GET['ptid']) ? $_GET['ptid'] : null; // ตรวจสอบว่ามี ptid ถูกส่งมาหรือไม่

$sql1 = "SELECT * FROM product_type WHERE pt_id='{$pt_id}'";
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
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
</head>

<body>
<center><h1>เขียนฝัน-แก้ไขประเภทสินค้า</h1></center>

<form class="form-container" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">ชื่อประเภทสินค้า</label>
            <div class="col-md-4">
                <input type="text" name="ptname" style="width: 300px" required autofocus value="<?= htmlspecialchars($data1['pt_name']); ?>"><br>
            </div>
        </div>

        <div class="mb-3">
            <label class="col-md-4 control-label " for="file">รูปภาพ</label>
            <div class="col-md-4">
                <input class="form-control" name="pimg" type="file" id="formFileMultiple" style="width: 300px;">
            </div>
        </div>
          <br><br>
		<button type="submit" name="Submit" class="btn btn-success center-block "> บันทึก </button>
        
    </fieldset>
</form>
<hr><hr>

<?php
if (isset($_POST['Submit'])) {
    // ตรวจสอบว่ามีไฟล์รูปภาพใหม่ที่อัปโหลดหรือไม่
    if ($_FILES['pimg']['name'] != "") {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
        $filename = $_FILES['pimg']['name'];
        $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // นามสกุลไฟล์

        if (!in_array($picture_ext, $allowed)) {
            echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            exit;
        }

        // ตั้งชื่อไฟล์ใหม่ให้ตรงกับ pt_id
        $new_filename = "type" . $pt_id . "." . $picture_ext;

        // ย้ายไฟล์รูปไปยังโฟลเดอร์ images ด้วยชื่อที่ตรงกับ p_id
        if (move_uploaded_file($_FILES['pimg']['tmp_name'], "images/" . $new_filename)) {
            // หากการอัปโหลดไฟล์สำเร็จ ทำการอัปเดตข้อมูลในฐานข้อมูล
            $sql = "UPDATE `product_type` SET `pt_name`='{$_POST['ptname']}', `t_picture`='{$new_filename}' WHERE `pt_id`='{$pt_id}'";

            // ทำการอัปเดตข้อมูลในฐานข้อมูล
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='a-type.php';</script>";
            } else {
                echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
        }
    } else {
        // กรณีที่ไม่ได้อัปโหลดรูปใหม่
        $sql = "UPDATE `product_type` SET `pt_name`='{$_POST['ptname']}' WHERE `pt_id`='{$pt_id}'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='a-type.php';</script>";
        } else {
            echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ: " . mysqli_error($conn) . "');</script>";
        }
    }
}

?>

</body>
</html>
