<?php
	include_once("r-checklogin.php");
	echo ($_SESSION['aname']);
?>
<!doctype html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
	<meta charset="utf-8">
	<title>ร้านเขียนฝัน</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<style>
        body, h1, h2, h3, h4, h5, h6, label, input, textarea, select, button {
            font-family: "Itim", cursive;
            font-weight: 500;
        }
    </style>
<body>
<center> <h1>เขียนฝัน- เพิ่มข้อมูลลูกค้า </h1> </center>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">ชื่อลูกค้า</label>
            <div class="col-md-4">
                <input type="text" name="cfullname" style="width: 300px" required autofocus value="<?=$data1['c_fullname'];?>"><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">ที่อยู่</label>
            <div class="col-md-4">
                <textarea name="caddress" rows="5" cols="50"><?=$data1['c_address'];?></textarea><br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="number">เบอร์โทรศัพท์</label>
            <div class="col-md-4">
                <input type="number" name="cphonnumber" required value="<?=$data1['c_phonnumber'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
		<div class="form-group">
            <label class="col-md-4 control-label" for="text">อีเมล</label>
            <div class="col-md-4">
                <input type="text" name="cemail" required value="<?=$data1['c_email'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
		<div class="form-group">
            <label class="col-md-4 control-label" for="number">รหัสผ่าน</label>
            <div class="col-md-4">
                <input type="password" name="cpassword" required value="<?=$data1['c_password'];?>" style="width: 200px;" step="0.01" min="0"><br>
            </div>
        </div>
        <br>

        
        <br>
			<br>

     
        <br><br>
        <button type="submit" name="Submit" class="btn btn-success center-block"> เพิ่ม </button>
    </fieldset>
</form>
<hr><hr>


<?php
if (isset($_POST['Submit'])) {
   if (isset($_POST['Submit'])) {
    // Receive form data
    $fullname = mysqli_real_escape_string($conn, $_POST['cfullname']);
    $address = mysqli_real_escape_string($conn, $_POST['caddress']);
    $phonnumber = mysqli_real_escape_string($conn, $_POST['cphonnumber']);
    $email = mysqli_real_escape_string($conn, $_POST['cemail']);
    $password = mysqli_real_escape_string($conn, $_POST['cpassword']);
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO customers (c_fullname, c_address, c_phonnumber, c_email, c_password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $fullname, $address, $phonnumber, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มข้อมูลลูกค้าสำเร็จ'); window.location='somewhere.php';</script>"; // Redirect after success
    } else {
        echo "<script>alert('เพิ่มข้อมูลลูกค้าไม่สำเร็จ: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
}
?>


</body>
</html>
