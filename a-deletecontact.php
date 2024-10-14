<?php
include("connectdb.php"); 
include_once("r-checklogin.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);


    $sql = "DELETE FROM contacts WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {

        header("Location:a-contact.php?message=delete_success");
        exit();
    } else {
        // ถ้าลบไม่สำเร็จให้แสดงข้อความผิดพลาด
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // ถ้าไม่มี ID ส่งมาให้ redirect กลับไปยังหน้าที่คุณต้องการ
    header("Location: a-managecustomer.php?message=delete_error");
    exit();
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);
?>
