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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <style>
        body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }

    </style>
</head>

<body>
    <div class="container">
        <center><h1 >เขียนฝัน - แก้ไขสินค้า</h1></center>

        <form class="form-horizontal text-center" method="post" action="" enctype="multipart/form-data">
            <fieldset>
                <!-- ชื่อสินค้า -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">ชื่อสินค้า</label>
                    <div class="col-md-4">
                        <input type="text" name="pname" class="form-control" required autofocus value="<?= htmlspecialchars($data1['p_name']); ?>">
                    </div>
                </div>

                <!-- รายละเอียดสินค้า -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">รายละเอียดสินค้า</label>
                    <div class="col-md-4">
                        <textarea name="pdetail" class="form-control" rows="5" required><?= htmlspecialchars($data1['p_detail']); ?></textarea>
                    </div>
                </div>

                <!-- ราคา -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="number">ราคา</label>
                    <div class="col-md-4">
                        <input type="number" name="pprice" class="form-control" required step="0.01" min="0" value="<?= htmlspecialchars($data1['p_price']); ?>">
                    </div>
                </div>

                <!-- รูปภาพ -->
                <?php for ($i = 1; $i <= 4; $i++) { ?>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="file">รูปภาพที่ <?= $i ?></label>
                    <div class="col-md-4">
                        <input class="form-control" name="pimg<?= $i ?>" type="file">
                        <input type="hidden" name="ppicture<?= $i ?>" value="<?= htmlspecialchars($data1["p_picture$i"]); ?>">
                    </div>
                </div>
                <?php } ?>

                <!-- ประเภทสินค้า -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="pt">ประเภทสินค้า</label>
                    <div class="col-md-4">
                        <select name="pt" class="form-control">
                            <?php
                            $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC";
                            $rs2 = mysqli_query($conn, $sql2);
                            while ($data2 = mysqli_fetch_array($rs2)) {
                            ?>
                                <option value="<?= htmlspecialchars($data2['pt_id']); ?>" <?=($data1['pt_id'] == $data2['pt_id']) ? "selected" : "";?>><?= htmlspecialchars($data2['pt_name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <!-- ปุ่มบันทึก -->
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="submit" name="Submit" class="btn btn-success">บันทึก</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>


<?php
if (isset($_POST['Submit'])) {
    $new_pictures = array();
    for ($i = 1; $i <= 4; $i++) {
        $new_pictures[$i] = $_POST["ppicture$i"];
        if ($_FILES["pimg$i"]['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES["pimg$i"]['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ! ไฟล์ต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
                exit;
            }
            $new_pictures[$i] = $p_id . ".$i." . $picture_ext;
            move_uploaded_file($_FILES["pimg$i"]['tmp_name'], "images/" . $new_pictures[$i]);
        }
    }

    $sql = "UPDATE `product` SET 
                `p_name`='{$_POST['pname']}', 
                `p_detail`='{$_POST['pdetail']}', 
                `p_price`='{$_POST['pprice']}', 
                `p_picture1`='{$new_pictures[1]}', 
                `p_picture2`='{$new_pictures[2]}', 
                `p_picture3`='{$new_pictures[3]}', 
                `p_picture4`='{$new_pictures[4]}', 
                `pt_id`='{$_POST['pt']}' 
            WHERE `p_id`='{$p_id}'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='a-product.php';</script>";
    } else {
        echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ: " . mysqli_error($conn) . "');</script>";
    }
}
?>

</body>
</html>
