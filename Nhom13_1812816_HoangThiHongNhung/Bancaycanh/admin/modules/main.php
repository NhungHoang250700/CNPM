
<div class="main">
    <?php
        if(isset($_GET['admin_moc'])){
            $tam = $_GET['admin_moc'];
        }else{
            $tam = '';
        }if($tam=='Banner'){
            include("banner.php");
        }elseif($tam=='Chuyenmuc'){
            include("categorypost.php");
        }
        elseif($tam=='Thembaiviet'){
            include("newpost.php");
        }
        elseif($tam=='Tatcabaiviet'){
            include("totalpost.php");
        }
      
        elseif($tam=='Danhmuc'){
            include("productline.php");
        }
        elseif($tam=='Themsanpham'){
            include("newproduct.php");
        }
        elseif($tam=='Tatcasanpham'){
            include("totalproduct.php");
        }
        elseif($tam=='Donhang'){
            include("order.php");
        }
        elseif($tam=='Chitiethoadon'){
            include("orderdetail.php");
        }
        elseif($tam=='Khachhang'){
            include("customer.php");
        }
        elseif($tam=='Lienhe'){
            include("contact.php");
        }else{
            include("banner.php");

        }



    ?>
</div>