<?php
include_once("r-checklogin.php");

if (isset($_GET['pid'])) {
    include("connectdb.php");
    
    $pid = $_GET['pid'];
    
    // ดึงชื่อรูปภาพทั้งหมดจากฐานข้อมูลก่อนลบ
    $sql = "SELECT p_picture1, p_picture2, p_picture3, p_picture4 FROM product WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($data = $result->fetch_assoc()) {
        // ลบข้อมูลจากฐานข้อมูล
        $delete_sql = "DELETE FROM product WHERE p_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $pid);
        $delete_stmt->execute();

        // ลบไฟล์รูปภาพจากโฟลเดอร์
        foreach ($data as $picture) {
            if (!empty($picture)) { // ตรวจสอบว่ามีชื่อไฟล์หรือไม่
                $file_path = "images/" . $picture;
                if (file_exists($file_path)) {
                    unlink($file_path); // ลบไฟล์
                }
            }
        }

        echo "<script>alert('ลบข้อมูลสินค้าสำเร็จ'); window.location='a-product.php';</script>";
    } else {
        echo "<script>alert('ไม่พบข้อมูลสินค้า'); window.location='a-product.php';</script>";
    }
    
    $stmt->close();
    $delete_stmt->close();
    mysqli_close($conn);
}
?>
