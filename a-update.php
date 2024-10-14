<?php
include_once("r-checklogin.php");
include_once("connectdb.php");

$p_id = isset($_GET['pid']) ? $_GET['pid'] : null; // ตรวจสอบว่ามี pid ถูกส่งมาหรือไม่

$sql1 = "SELECT * FROM product WHERE p_id='{$p_id}'";
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
    .f1 {
        font-family: "Itim", cursive;
        font-weight: 500;
    }
</style>
<body>
<center><h1 class="f1">เขียนฝัน - แก้ไขสินค้า</h1></center>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="textinput">ชื่อสินค้า</label>
            <div class="col-md-4">
                <input type="text" class="f1" name="pname" style="width: 300px" required autofocus value="<?=$data1['p_name'];?>"><br>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="textarea">รายละเอียดสินค้า</label>
            <div class="col-md-4">
                <textarea name="pdetail" class="f1" rows="5" cols="50"><?=$data1['p_detail'];?></textarea><br>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="number">ราคา</label>
            <div class="col-md-4">
                <input type="number" class="f1" name="pprice" required value="<?=$data1['p_price'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="file">รูปภาพที่1 </label>
            <div class="col-md-4">
                <input class="form-control f1" name="pimg1" type="file" id="formFileMultiple">
                <input type="hidden" name="old_picture1" value="<?=$data1['p_picture1'];?>">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="file">รูปภาพที่ 2</label>
            <div class="col-md-4">
                <input class="form-control f1" name="pimg2" type="file" id="formFileMultiple">
                <input type="hidden" name="old_picture2" value="<?=$data1['p_picture2'];?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="file">รูปภาพที่ 3 </label>
            <div class="col-md-4">
                <input class="form-control f1" name="pimg3" type="file" id="formFileMultiple">
                <input type="hidden" name="old_picture3" value="<?=$data1['p_picture3'];?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="file">รูปภาพที่ 4</label>
            <div class="col-md-4">
                <input class="form-control f1" name="pimg4" type="file" id="formFileMultiple">
                <input type="hidden" name="old_picture4" value="<?=$data1['p_picture4'];?>">
            </div>
        </div>

        <br>
        <div class="form-group row">
            <label class="col-md-4 control-label f1" for="pt">ประเภทสินค้า</label>
            <div class="col-md-4">
                <select name="pt" class="form-select f1">
                    <?php
                    $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC";
                    $rs2 = mysqli_query($conn, $sql2);
                    while ($data2 = mysqli_fetch_array($rs2)) {
                    ?>
                        <option value="<?=$data2['pt_id'];?>" <?=($data1['pt_id'] == $data2['pt_id']) ? "selected" : "";?> ><?=$data2['pt_name'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br>
        <button type="submit" name="Submit" class="btn btn-success center-block f1">บันทึก</button>
    </fieldset>
</form>
<?php
if (isset($_POST['Submit'])) {
    // กำหนดตัวแปรสำหรับชื่อไฟล์ใหม่
    $new_picture1 = $_POST['old_picture1'];
    $new_picture2 = $_POST['old_picture2'];
    $new_picture3 = $_POST['old_picture3'];
    $new_picture4 = $_POST['old_picture4'];

    // ตรวจสอบว่ามีไฟล์รูปภาพใหม่ที่อัปโหลดหรือไม่ และกำหนดชื่อไฟล์ตามรูปแบบที่กำหนด
    if ($_FILES['pimg1']['name'] != "") {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
        $filename = $_FILES['pimg1']['name'];
        $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($picture_ext, $allowed)) {
            echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            exit;
        }
        $new_picture1 = $p_id . ".1." . $picture_ext; // ตั้งชื่อไฟล์ใหม่เป็น 1.1
        copy($_FILES['pimg1']['tmp_name'], "images/" . $new_picture1);
    }

    if ($_FILES['pimg2']['name'] != "") {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
        $filename = $_FILES['pimg2']['name'];
        $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($picture_ext, $allowed)) {
            echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            exit;
        }
        $new_picture2 = $p_id . ".2." . $picture_ext; // ตั้งชื่อไฟล์ใหม่เป็น 1.2
        copy($_FILES['pimg2']['tmp_name'], "images/" . $new_picture2);
    }

    if ($_FILES['pimg3']['name'] != "") {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
        $filename = $_FILES['pimg3']['name'];
        $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($picture_ext, $allowed)) {
            echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            exit;
        }
        $new_picture3 = $p_id . ".3." . $picture_ext; // ตั้งชื่อไฟล์ใหม่เป็น 1.3
        copy($_FILES['pimg3']['tmp_name'], "images/" . $new_picture3);
    }

    if ($_FILES['pimg4']['name'] != "") {
        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
        $filename = $_FILES['pimg4']['name'];
        $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($picture_ext, $allowed)) {
            echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            exit;
        }
        $new_picture4 = $p_id . ".4." . $picture_ext; // ตั้งชื่อไฟล์ใหม่เป็น 1.4
        copy($_FILES['pimg4']['tmp_name'], "images/" . $new_picture4);
    }

    // สร้าง SQL สำหรับอัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE `product` SET 
                `p_name`='{$_POST['pname']}', 
                `p_detail`='{$_POST['pdetail']}', 
                `p_price`='{$_POST['pprice']}', 
                `p_picture1`='{$new_picture1}', 
                `p_picture2`='{$new_picture2}', 
                `p_picture3`='{$new_picture3}', 
                `p_picture4`='{$new_picture4}', 
                `pt_id`='{$_POST['pt']}' 
            WHERE `p_id`='{$p_id}';";

    // ทำการอัปเดตข้อมูลในฐานข้อมูล
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='a-product.php';</script>";
    } else {
        echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');</script>";
    }
}
?>

</body>
</html>
