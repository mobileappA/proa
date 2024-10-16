<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัปโหลดรูปภาพ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .f1 {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <h1 class="text-center f1">อัปโหลดรูปภาพ</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileInput" class="form-label f1">เลือกไฟล์รูปภาพ:</label>
                <input class="form-control" type="file" name="image" id="fileInput" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">อัปโหลด</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            if ($_FILES['image']['name'] != "") {
                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif','ico');
                $filename = $_FILES['image']['name'];
                $picture_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (!in_array($picture_ext, $allowed)) {
                    echo "<script>alert('อัปโหลดไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg, gif หรือ png เท่านั้น');</script>";
                } else {
                    // ตั้งชื่อไฟล์ใหม่
                    $new_filename = "logo01." . $picture_ext;

                    // ย้ายไฟล์รูปไปยังโฟลเดอร์ images
                    if (move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $new_filename)) {
                        echo "<script>alert('อัปโหลดรูปภาพสำเร็จ');</script>";
                    } else {
                        echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>
