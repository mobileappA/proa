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
// PHP code สำหรับการเพิ่มสินค้าและการจัดการไฟล์ที่คุณให้มา
?>

</body>
</html>
