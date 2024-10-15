<?php  
include_once("r-checklogin.php");
include_once("connectdb.php");
?>

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
<center><h1>เขียนฝัน- เพิ่มสินค้า</h1></center>

<form class="form-horizontal f1" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <!-- ชื่อสินค้า -->
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="textinput">ชื่อสินค้า</label>
            <div class="col-md-4">
                <input type="text" name="pname" style="width: 300px" required autofocus value="<?= htmlspecialchars($data1['p_name']); ?>"><br>
            </div>
        </div>

        <!-- รายละเอียดสินค้า -->
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="textarea">รายละเอียดสินค้า</label>
            <div class="col-md-4">
                <textarea name="pdetail" rows="5" cols="50" required></textarea><br>
            </div>
        </div>

        <!-- ราคา -->
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="number">ราคา</label>
            <div class="col-md-4">
                <input type="number" name="pprice" required value="" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>

        <!-- รูปภาพ -->
        <?php for ($i = 1; $i <= 4; $i++) { ?>
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="file">รูปภาพที่ <?= $i ?></label>
            <div class="col-md-4">
                <input class="form-control" name="pimg<?= $i ?>" type="file">
                <input type="hidden" name="ppicture<?= $i ?>" >
            </div>
        </div>
        <?php } ?>

        <!-- ประเภทสินค้า -->
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="pt">ประเภทสินค้า</label>
            <div class="col-md-4">
                <select name="pt" class="form-select f1">
                    <?php
                    $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC";
                    $rs2 = mysqli_query($conn, $sql2);
                    while ($data2 = mysqli_fetch_array($rs2)) {
                    ?>
                        <option value="<?= htmlspecialchars($data2['pt_id']); ?>" <?=($data1['pt_id'] == $data2['pt_id']) ? "selected" : "";?> >
                            <?= htmlspecialchars($data2['pt_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <!-- ปุ่มบันทึก -->
        <br><br>
        <button type="submit" name="Submit" class="btn btn-success center-block f1">บันทึก</button>
    </fieldset>
</form>
<hr>

<?php
if (isset($_POST['Submit'])) {
    // สร้าง SQL สำหรับเพิ่มข้อมูลสินค้าใหม่ลงในฐานข้อมูล
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

        // จัดการรูปภาพ
        $new_pictures = array();
        for ($i = 1; $i <= 4; $i++) {
            $new_pictures[$i] = $_POST["ppicture$i"];
            if ($_FILES["pimg$i"]['name'] != "") {
                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
                $filename = $_FILES["pimg$i"]['name'];
                $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($picture_ext, $allowed)) {
                    echo "<script>alert('เพิ่มสินค้าล้มเหลว! ไฟล์ต้องเป็น gif, png, jpg, jpeg, jfif เท่านั้น');</script>";
                    exit;
                }
                $new_pictures[$i] = $p_id . ".$i." . $picture_ext;
                move_uploaded_file($_FILES["pimg$i"]['tmp_name'], "images/" . $new_pictures[$i]);
            }
        }

        // สร้าง SQL สำหรับอัปเดตชื่อไฟล์ในฐานข้อมูล
        $sql_update = "UPDATE `product` SET 
                            `p_picture1`='{$new_pictures[1]}', 
                            `p_picture2`='{$new_pictures[2]}', 
                            `p_picture3`='{$new_pictures[3]}', 
                            `p_picture4`='{$new_pictures[4]}' 
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
