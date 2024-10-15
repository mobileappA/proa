<?php
include_once("r-checklogin.php");
include_once("connectdb.php");

echo ($_SESSION['aname']);
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
        input::placeholder {
            font-family: "Itim", cursive;
            color: #aaa;
            font-size: 14px;
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
    </style>
</head>

<body>
<center><h1><span class="f1">เขียนฝัน-เพิ่มประเภทสินค้า</span></h1></center>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label f1" for="textinput">ชื่อประเภทสินค้า</label>
            <div class="col-md-4">
                <input id="textinput" name="ptname" type="text" class="form-control input-md" required autofocus><br>
            </div>
        </div>

        <div class="mb-3-center">
            <div class="name-center">
                <label class="col-md-4 control-label f1" for="formFileMultiple">รูปภาพ</label>
                <input class="form-control f1" name="pimg" type="file" id="formFileMultiple" style="width: 300px;">
            </div>
        </div>
        <br>

        <button type="submit" name="Submit" class="btn btn-success center-block f1">เพิ่ม</button>
    </fieldset>
</form>
<hr>

<?php
if (isset($_POST['Submit'])) {
    // รับข้อมูลจากฟอร์ม
    $ptname = $_POST['ptname'];

    // สร้าง SQL สำหรับเพิ่มข้อมูลสินค้าใหม่ลงในฐานข้อมูล
    $sql_insert = "INSERT INTO product_type (pt_name) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("s", $ptname);

    if ($stmt->execute()) {
        // รับ pt_id ของข้อมูลที่เพิ่งถูกเพิ่ม
        $pt_id = $stmt->insert_id;

        // ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
        if ($_FILES['pimg']['name'] != "") {
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename = $_FILES['pimg']['name'];
            $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            // ตรวจสอบชนิดของไฟล์
            if (!in_array($picture_ext, $allowed)) {
                echo "<script>alert('แก้ไขข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
            } else {
                // ตั้งชื่อไฟล์ใหม่โดยใช้ pt_id
                $new_filename = "type" . $pt_id . "." . $picture_ext;
                $destination_path = "images/" . $new_filename;

                // ย้ายไฟล์ไปยังโฟลเดอร์เก็บภาพ
                if (move_uploaded_file($_FILES['pimg']['tmp_name'], $destination_path)) {
                    // อัปเดตชื่อไฟล์ในฐานข้อมูล
                    $sql_update = "UPDATE product_type SET t_picture = ? WHERE pt_id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("si", $new_filename, $pt_id);

                    if ($stmt_update->execute()) {
                        echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ'); window.location='a-type.php';</script>";
                    } else {
                        echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูลในฐานข้อมูล');</script>";
                    }

                    $stmt_update->close();
                } else {
                    echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
                }
            }
        } else {
            echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ'); window.location='a-type.php';</script>";
        }
    } else {
        echo "<script>alert('เพิ่มข้อมูลสินค้าไม่สำเร็จ');</script>";
    }

    $stmt->close();
}

mysqli_close($conn);
?>
</body>
</html>
