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
                <input class="form-control f1" name="pimg" type="file" id="formFileMultiple" multiple style="width: 300px;">
            </div>
        </div>
        <br>

        <button type="submit" name="Submit" class="btn btn-success center-block f1">เพิ่ม</button>
    </fieldset>
</form>
<hr>

<?php
if (isset($_POST['Submit'])) {
    // ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
    if (isset($_FILES['pimg']) && $_FILES['pimg']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['pimg']['name'];
        $file_tmp = $_FILES['pimg']['tmp_name'];
        $picture_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // ดึงนามสกุลไฟล์
        $allowed_picture = array('jpg', 'jpeg', 'png', 'gif'); // ชนิดไฟล์ที่อนุญาต

        // ตรวจสอบชนิดของไฟล์
        if (in_array($picture_ext, $allowed_picture)) {
            // ตรวจสอบขนาดไฟล์ (ไม่เกิน 2MB)
            if ($_FILES['pimg']['size'] <= 2 * 1024 * 1024) {
                // เก็บข้อมูลจากฟอร์ม
                $ptname = $_POST['ptname'];

                // เตรียมคำสั่ง SQL สำหรับเพิ่มประเภทสินค้าใหม่
                $stmt = $conn->prepare("INSERT INTO product_type (pt_name) VALUES (?)");
                if (!$stmt) {
                    die("เตรียมคำสั่งล้มเหลว: " . $conn->error);
                }

                // ผูกค่าตัวแปร
                $stmt->bind_param("s", $ptname);

                // ทำการ execute
                if ($stmt->execute()) {
                    // รับ ID ประเภทสินค้าที่เพิ่งเพิ่ม
                    $idauto = $stmt->insert_id;

                    // ตั้งชื่อไฟล์ใหม่ให้ตรงกับ pt_id ที่ได้
                    $new_filename = "images/"."type" . $idauto . "." . $picture_ext;
                    $new_filename_in_db = "type" . $idauto . "." . $picture_ext; // ชื่อที่จะบันทึกลงฐานข้อมูล

                    // ย้ายไฟล์ไปยังโฟลเดอร์เก็บภาพ
                    if (move_uploaded_file($file_tmp, $new_filename)) {
                        // อัปเดตชื่อไฟล์ในฐานข้อมูลหลังจากย้ายไฟล์สำเร็จ
                        $stmt_update = $conn->prepare("UPDATE product_type SET t_picture = ? WHERE pt_id = ?");
                        if (!$stmt_update) {
                            die("เตรียมคำสั่งอัปเดตล้มเหลว: " . $conn->error);
                        }

                        // ผูกค่ากับพารามิเตอร์สำหรับการอัปเดต
                        $stmt_update->bind_param("si", $new_filename_in_db, $idauto);
                        $stmt_update->execute();
                        $stmt_update->close();
                    }

                    echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ'); window.location='a-type.php';</script>";
                } else {
                    echo "<script>alert('เพิ่มข้อมูลสินค้าไม่สำเร็จ');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('ขนาดไฟล์ใหญ่เกินไป');</script>";
            }
        } else {
            echo "<script>alert('ชนิดไฟล์ไม่ถูกต้อง');</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');</script>";
    }
}

mysqli_close($conn);
?>
</body>
</html>
