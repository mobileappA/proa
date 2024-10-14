<?php
@session_start();

// ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
if (isset($_SESSION['sid'])) {
    // ลบข้อมูลที่เกี่ยวข้องกับตะกร้า
    unset($_SESSION['sid']);
    unset($_SESSION['sname']);
    unset($_SESSION['sprice']);
    unset($_SESSION['sitem']);
    unset($_SESSION['spicture']);
}

echo "ตะกร้าสินค้าได้รับการเคลียร์แล้ว กำลังกลับหน้าหลัก กรุณารอสักครู่....";
echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
?>
<meta charset="utf-8">
