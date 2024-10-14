<?php
include_once("r-checklogin.php");
?>
<?php
if(isset($_GET['ptid'])){
    include("connectdb.php");

  
    $sql = "DELETE FROM product_type WHERE `pt_id` = '{$_GET['ptid']}' ";

    // รันคำสั่งลบ
    if(mysqli_query($conn, $sql)){
        echo "<script>";
        echo "alert('ลบข้อมูลประเภทสินค้าเรียบร้อยแล้ว');"; // แจ้งข้อความสำเร็จ
        echo "window.location='a-type.php';";   // กลับไปหน้าจัดการประเภท
        echo "</script>";
    } else {
        // แสดงข้อความข้อผิดพลาดถ้ามีปัญหา
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในการลบข้อมูลประเภทสินค้า');";
        echo "window.location='a-type.php';";   // กลับไปหน้าจัดการประเภท
        echo "</script>";
    }
}
?>
