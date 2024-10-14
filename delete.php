<?php
include_once("r-checklogin.php");
?>
<?php
if(isset($_GET['cid'])){
    include("connectdb.php");

  
    $sql = "DELETE FROM customer WHERE `c_id` = '{$_GET['cid']}' ";

    // รันคำสั่งลบ
    if(mysqli_query($conn, $sql)){
        echo "<script>";
        echo "alert('ลบข้อมูลลูกค้าเรียบร้อยแล้ว');"; // แจ้งข้อความสำเร็จ
        echo "window.location='a-managecustomer.php';";   // กลับไปหน้าจัดการลูกค้า
        echo "</script>";
    } else {
        // แสดงข้อความข้อผิดพลาดถ้ามีปัญหา
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในการลบข้อมูลลูกค้า');";
        echo "window.location='a-managecustomer.php';";   // กลับไปหน้าจัดการลูกค้า
        echo "</script>";
    }
}
?>
