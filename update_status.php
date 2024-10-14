<?php
include("connectdb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oid = mysqli_real_escape_string($conn, $_POST['oid']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // อัปเดตสถานะในฐานข้อมูล
    $sql = "UPDATE orders SET status='$status' WHERE oid='$oid'";

    if (mysqli_query($conn, $sql)) {
        echo "อัปเดตสถานะสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }

    // กลับไปยังหน้าก่อนหน้า
    header("Location:a-manageorder.php"); // เปลี่ยนเป็นหน้าที่ต้องการหลังอัปเดต
    exit();
}
?>
