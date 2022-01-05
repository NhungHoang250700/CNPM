<?php
include '../db/config.php';
	if(isset($_SESSION['customerName'])){
	
$id_ct=$_SESSION['customerName'];
$sql_select_customer = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$id_ct'");
$row_customerNumber = mysqli_fetch_array($sql_select_customer);
$id=$row_customerNumber['customerNumber'];

// $sql_insert_pd=mysqli_query($con," INSERT INTO cart(productCode, productQuantity) VALUE('$_GET[idspgh]','1')");
$sql_select_giohang = mysqli_query($con,"SELECT * FROM cart  WHERE productCode='$_GET[idspgh]' AND customerNumber='$id'");
 	$count = mysqli_num_rows($sql_select_giohang);
 	if($count>0){
 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
		 
 		$soluong = $row_sanpham['productQuantity'] + 1;
 		$sql_giohang = "UPDATE cart SET productQuantity='$soluong' WHERE productCode='$_GET[idspgh]'";
	
 	}else{
 		$soluong = 1;
 		$sql_giohang = "INSERT INTO cart(productCode, productQuantity, customerNumber) values ('$_GET[idspgh]','$soluong','$id')";

 	}
 	$insert_row = mysqli_query($con,$sql_giohang);
	 include("totalcart.php");
	 exit();
	
}
else{
	?>
	<?php
if(isset($_POST["submit_login"])) {
    $taikhoan=$_POST["customerName"];
    $matkhau=$_POST["password"];

    if($taikhoan == ''|| $matkhau==''){
        echo '<script>alert("Làm ơn không để trống")</script>';
    }
    else{
        $sql_selecter_admin= mysqli_query($con, "SELECT * FROM `customers` WHERE customerName='$taikhoan' AND password='$matkhau' LIMIT 1");
        $count=mysqli_num_rows($sql_selecter_admin);
        $kq_login=mysqli_fetch_array($sql_selecter_admin);
       
        if($count>0){
            $f_user=$kq_login['customerName'];
            $f_pass=$kq_login['password'];
                
            
            $_SESSION['customerName']= $f_user;
            $_SESSION['password']= $f_pass;
            
            header('Location: index.php?web_moc=Trangchu');
        }
        else{
            echo '<script>alert("Tài khoản hoặc mật khẩu sai")</script>';
        }
    }
    exit();
 }
 ?>
	<div class="modal-dialog modal-login">
		<div class="modal-content" >
			<form action="" method="post">
				<div class="modal-header">				
					<h4 class="modal-title">Login</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Username</label>
						<input name="customerName" data-success="right" type="text" class="form-control" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Password</label>
							<a href="#" class="float-right text-muted"><small>Forgot?</small></a>
						</div>
						
						<input name="password" type="password" class="form-control" required="required">
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<label class="form-check-label"><input type="checkbox" > Remember me</label>

					<input type="submit" class="btn btn-primary" value="Login" name="submit_login">
				</div>

			</form>
		</div>
	</div>
<?php
}

?>