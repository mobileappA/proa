<?php  include_once("r-checklogin.php");
 include_once("connectdb.php");?>

<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน</title>
    <style>
        body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
    </style>
</head>
<body>
<center> <h1>เขียนฝัน- เพิ่มสินค้า </h1> </center>

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">ชื่อสินค้า</label>
            <div class="col-md-4">
                <input id="textinput" name="pname" type="text" class="form-control input-md" required autofocus><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">รายละเอียดสินค้า</label>
            <div class="col-md-4">
                <textarea class="form-control" id="textarea" name="pdetail"></textarea><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="number">ราคา</label>
            <div class="col-md-4">
                <input id="textinput" name="pprice" type="number" style="width: 200px;" class="form-control input-md" required>
            </div>
        </div>
        <br>
        
        <div class="form-group">
            <label class="col-md-4 control-label" for="pimg1">รูปภาพ 1</label>
            <div class="col-md-4">
                <input class="form-control" name="pimg1" type="file" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="pimg2">รูปภาพ 2</label>
            <div class="col-md-4">
                <input class="form-control" name="pimg2" type="file">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="pimg3">รูปภาพ 3</label>
            <div class="col-md-4">
                <input class="form-control" name="pimg3" type="file">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="pimg4">รูปภาพ 4</label>
            <div class="col-md-4">
                <input class="form-control" name="pimg4" type="file">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="col-md-4 control-label" for="ptname">ประเภทสินค้า</label>
            <select name="pt" id="pt" class="form-select">
                <?php
               
                $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC ";
                $rs2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_array($rs2)) {
                ?>
                    <option value="<?=$data2['pt_id'];?>"><?=$data2['pt_name'];?></option>
                <?php } ?>
            </select>
            <br><br>
            <button type="submit"  class="btn btn-success center-block">เพิ่ม</button>
        </div>
    </fieldset>
</form>
<hr>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กำหนดตัวแปรสำหรับชื่อไฟล์ใหม่
    $new_picture1 = '';
    $new_picture2 = '';
    $new_picture3 = '';
    $new_picture4 = '';

    // สร้าง SQL สำหรับเพิ่มข้อมูลสินค้าใหม่ลงในฐานข้อมูลก่อน เพื่อให้ได้ p_id
    $sql_insert = "INSERT INTO `product` (`p_name`, `p_detail`, `p_price`, `pt_id`) 
                   VALUES (
                       '{$_POST['pname']}', 
                       '{$_POST['pdetail']}', 
                       '{$_POST['pprice']}', 
                       '{$_POST['pt']}'
                   );";

    if (mysqli_query($conn, $sql_insert)) {
        // รับ p_id ที่เพิ่งถูกสร้างใหม่
        $p_id = mysqli_insert_id($conn);

        // ตรวจสอบว่ามีไฟล์รูปภาพใหม่ที่อัปโหลดหรือไม่ และกำหนดชื่อไฟล์ตาม p_id
        if ($_FILES['pimg1']['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES['pimg1']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('เพิ่มสินค้าล้มเหลว! ไฟล์รูปต้องเป็น jgif, png, jpg, jpeg, jfif เท่านั้น');</script>";
                exit;
            }
            $new_picture1 = $p_id . ".1." . $picture_ext; // ตั้งชื่อไฟล์เป็น p_id.1
            copy($_FILES['pimg1']['tmp_name'], "images/" . $new_picture1);
        }

        if ($_FILES['pimg2']['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES['pimg2']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('เพิ่มสินค้าล้มเหลว! ไฟล์รูปต้องเป็น jgif, png, jpg, jpeg, jfif เท่านั้น');</script>";
                exit;
            }
            $new_picture2 = $p_id . ".2." . $picture_ext; // ตั้งชื่อไฟล์เป็น p_id.2
            copy($_FILES['pimg2']['tmp_name'], "images/" . $new_picture2);
        }

        if ($_FILES['pimg3']['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES['pimg3']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($picture_ext, $allowed)) {
                 echo "<script>alert('เพิ่มสินค้าล้มเหลว! ไฟล์รูปต้องเป็น jgif, png, jpg, jpeg, jfif เท่านั้น');</script>";
                exit;
            }
            $new_picture3 = $p_id . ".3." . $picture_ext; // ตั้งชื่อไฟล์เป็น p_id.3
            copy($_FILES['pimg3']['tmp_name'], "images/" . $new_picture3);
        }

        if ($_FILES['pimg4']['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES['pimg4']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('เพิ่มสินค้าล้มเหลว! ไฟล์รูปต้องเป็น jgif, png, jpg, jpeg, jfif เท่านั้น');</script>";
                exit;
            }
            $new_picture4 = $p_id . ".4." . $picture_ext; // ตั้งชื่อไฟล์เป็น p_id.4
            copy($_FILES['pimg4']['tmp_name'], "images/" . $new_picture4);
        }

        // สร้าง SQL สำหรับอัปเดตชื่อไฟล์ในฐานข้อมูล
        $sql_update = "UPDATE `product` SET 
                            `p_picture1`='{$new_picture1}', 
                            `p_picture2`='{$new_picture2}', 
                            `p_picture3`='{$new_picture3}', 
                            `p_picture4`='{$new_picture4}' 
                        WHERE `p_id`='{$p_id}';";

        // ทำการอัปเดตชื่อไฟล์ในฐานข้อมูล
        if (mysqli_query($conn, $sql_update)) {
            echo "<script>alert('เพิ่มสินค้าสำเร็จ'); window.location='a-product.php';</script>";
        } else {
            echo "<script>alert('เพิ่มสินค้าล้มเหลว');</script>";
        }

    } else {
        echo "<script>alert('เพิ่มสินค้าล้มเหลว');</script>";
    }
}
?>




</body>
</html>
