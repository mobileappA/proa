<?php  
include_once("r-checklogin.php");
include_once("connectdb.php");

echo ($_SESSION['aname']);
?>
<!doctype html>
<html>
<head>
<link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>ร้านเขียนฝัน</title>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <style>
        body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }

    </style>
</head>

<body>
<center><h1>เขียนฝัน-เพิ่มประเภทสินค้า</h1></center>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label " for="textinput">ชื่อประเภทสินค้า</label>
            <div class="col-md-4">
                <input id="textinput" name="ptname" type="text" class="form-control input-md" required autofocus><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label " for="formFileMultiple">รูปภาพ</label>
            <div class="col-md-4">
                <input class="form-control " name="pimg" type="file" id="formFileMultiple" style="width: 300px;">
            </div>
        </div>
        <br>

        <button type="submit" name="Submit" class="btn btn-success center-block">เพิ่ม</button>
    </fieldset>
</form>
<hr>

<?php
if (isset($_POST['Submit'])) {
    $ptname = $_POST['ptname'];
    $sql_insert = "INSERT INTO product_type (pt_name) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("s", $ptname);

    if ($stmt->execute()) {
        $pt_id = $stmt->insert_id; //ตารางมีคอลัมน์เป็น AUTO
        $image_uploaded = $_FILES['pimg']['name'] != "";
        
        if ($image_uploaded) {
            $allowed = ['gif', 'png', 'jpg', 'jpeg', 'jfif'];
            $filename = $_FILES['pimg']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
                exit;
            }

            $new_filename = "type" . $pt_id . "." . $picture_ext;
            $destination_path = "images/" . $new_filename;

            if (move_uploaded_file($_FILES['pimg']['tmp_name'], $destination_path)) {
                $sql_update = "UPDATE product_type SET t_picture = ? WHERE pt_id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("si", $new_filename, $pt_id);

                if ($stmt_update->execute()) {
                    echo "<script>alert('เพิ่มข้อมูลประเภทสินค้าสำเร็จ'); window.location='a-type.php';</script>";
                } else {
                    echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูลในฐานข้อมูล');</script>";
                }
                $stmt_update->close();
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            }
        } else {
            echo "<script>alert('เพิ่มข้อมูลประเภทสินค้าสำเร็จ'); window.location='a-type.php';</script>";
        }
    } else {
        echo "<script>alert('เพิ่มข้อมูลประเภทสินค้าไม่สำเร็จ');</script>";
    }

    $stmt->close();
}

mysqli_close($conn);
?>
</body>
</html>
