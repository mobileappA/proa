<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อเรา</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ฟอนต์ Google -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: "Itim", cursive;
            background-color: #f8f9fa;
        }
        .contact-info {
            margin: 20px 0;
        }
        .contact-info h4 {
            margin-bottom: 15px;
        }
        .icon {
            font-size: 24px;
            color: #007bff;
            margin-right: 10px;
        }
        .form-control, .btn {
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container my-5">
    <a href="index.php" class="btn position-absolute top-0 end-0 m-2"><i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i></a>
        <h1 class="text-center mb-4">ติดต่อเรา</h1>
        <div class="contact-info">
            <h4><i class="bi bi-house icon"></i>ที่อยู่</h4>
            <p>มหาวิทยาลัยมหาสารคาม ต.ขามเรียง ต.กันทรวิชัย  จ.มหาสารคาม 44150</p>

            <h4><i class="bi bi-telephone icon"></i>เบอร์โทร</h4>
            <p>0612345678</p>

            <h4><i class="bi bi-envelope icon"></i>อีเมล</h4>
            <p>appm81554@gmail.com</p>
        </div>

        <h2 class="mt-5">ส่งข้อความถึงเรา</h2>
        <form method="POST" action="">
    <div class="mb-3">
        <label for="name" class="form-label">ชื่อ</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อของคุณ" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">อีเมล</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="@example.com" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">ข้อความ</label>
        <textarea class="form-control" id="message" name="message" rows="4" placeholder="ข้อความของคุณ" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
</form>

    </div>
    <?php
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('ส่งข้อความเรียบร้อยแล้ว'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

   
    mysqli_close($conn);
}

?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
