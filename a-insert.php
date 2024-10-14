<?php  include_once("r-checklogin.php");?>

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

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
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
                include_once("connectdb.php");
                $sql2 = "SELECT * FROM product_type ORDER BY pt_name ASC ";
                $rs2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_array($rs2)) {
                ?>
                    <option value="<?=$data2['pt_id'];?>"><?=$data2['pt_name'];?></option>
                <?php } ?>
            </select>
            <br><br>
            <button type="submit" name="Submit" class="btn btn-success center-block">เพิ่ม</button>
        </div>
    </fieldset>
</form>
<hr>
<?php
include_once("connectdb.php"); // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าข้อมูลฟอร์มมีการส่งมาหรือไม่
    if (isset($_POST['pname'], $_POST['pdetail'], $_POST['pprice'], $_POST['pt'])) {
        // รับข้อมูลจากฟอร์ม
        $pname = $_POST['pname'];
        $pdetail = $_POST['pdetail'];
        $pprice = $_POST['pprice'];
        $pt = $_POST['pt'];

        // เริ่มต้นตัวแปรสำหรับการอัปโหลดไฟล์
        $uploads = [];
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_FILES["pimg$i"]) && $_FILES["pimg$i"]['error'] == 0) {
                // เช็คไฟล์และอัปโหลด
                $uploads[$i] = 'uploads/' . basename($_FILES["pimg$i"]["name"]);
                move_uploaded_file($_FILES["pimg$i"]["tmp_name"], $uploads[$i]);
            } else {
                $uploads[$i] = null; // หากไม่มีไฟล์ให้เซ็ตเป็น null
            }
        }

        // เตรียมคำสั่ง SQL
        $sql = "INSERT INTO products (p_name, p_detail, p_price, pt_id, p_img1, p_img2, p_img3, p_img4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // เตรียม statement
        $stmt = mysqli_prepare($conn, $sql);
        
        // ผูกตัวแปร
        mysqli_stmt_bind_param($stmt, "ssissssss", $pname, $pdetail, $pprice, $pt, $uploads[1], $uploads[2], $uploads[3], $uploads[4]);

        // ตรวจสอบว่าคิวรีสำเร็จหรือไม่
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('เพิ่มสินค้าสำเร็จ'); window.location='your_success_page.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_stmt_error($stmt) . "');</script>";
        }

        // ปิด statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

</body>
</html>
