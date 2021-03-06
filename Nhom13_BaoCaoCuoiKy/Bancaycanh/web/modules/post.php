<?php
include '../db/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bố cục trang web Bootstrap 4 --- dammio.com</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/post.css" class="css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>
 
<div class="container">
  <div class="row">
    <?php
    $sum_post_page= !empty($_GET['per-page'])?$_GET['per-page']:8;
    $current_page= !empty($_GET['page'])?$_GET['page']:1;
    $offset=($current_page -1 ) * $sum_post_page;
    $sql_select_post = mysqli_query($con,"SELECT * FROM newpost ORDER BY id_post DESC LIMIT $sum_post_page OFFSET $offset");
    $totalRecord=mysqli_query($con,"SELECT * FROM newpost");
    $row_count=mysqli_num_rows($totalRecord);
    $totalPages= ceil($row_count/$sum_post_page);
    $row_product = mysqli_fetch_array($sql_select_post)
    ?>
    <div class="col-12 my-4 text-uppercase font13 cl_nau" id="breadcrumbs"><span><span>
      <a href="index.php?web_moc=Trangchu">Trang chủ</a>
      <i class="fa fa-angle-right"></i>
      <span class="breadcrumb_last" aria-current="page">BÀI VIẾT</span></span></span>
    </div>
    <div class="col-sm-9">
    <div class="product_new">
        <div class="pd-new">

            <div class="title-pd-new">
                <h4>BÀI VIẾT</h4>
            </div>
            <div class="row pd">
                <?php
                $sql_post= mysqli_query($con, "SELECT * FROM newpost ");
                while ($row_post = mysqli_fetch_array($sql_post)) {
                    ?>
                <div class="col-6">
                    <div class="post">
                <div class="image-pt">
                <a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>" >

                    <img width="395" height="350" src="../admin/image/post/<?php echo $row_post['image_post']?>" >
                </a>
                </div>
                <div class="text-pt">
                
                        <p><i class="fa fa-calendar-o"></i><?php echo $row_post['date_post']?></p>
                
                    <h5><a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>"><?php echo $row_post['name_post'] ?></a></h5>
                    <?php echo $row_post['summery_post'] ?>
                </div>
                <div class="read"><a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>">Xem thêm</a></div>
                </div>
                </div>
            
                <?php
                }
                ?>
                </div>
                

        </div>
 

                <!-- ======================Pagination=================== -->
          <nav aria-label="..." class ="pagina-button">
            <ul class="pagination">
              <?php
                if($current_page > 2){
                  $fist_page=1;
              ?>
              <li class="page-item">
                <a class="page-link" href="?web_moc=Tatcabaiviet&id=<?php echo $_GET['id']?>&per-page=<?php echo $sum_post_page?>&page=<?php echo $fist_page?>">First</a>
              </li>
              <?php
                }if($current_page > 1){
                  $prev_page=$current_page-1;
              ?>
              <li class="page-item">
                <a class="page-link" href="?web_moc=Tatcabaiviet&id=<?php echo $_GET['id']?>&per-page=<?php echo $sum_post_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
              </li>
              <?php
              }
              ?>
              <?php for($num=1;$num <= $totalPages;$num++){
                if($num != $current_page){
                  if($num > $current_page -2 && $num <= $current_page + 2){
              ?>
              <li class="page-item">
                <a class="page-link" href="?web_moc=Tatcabaiviet&id=<?php echo $_GET['id']?>&per-page=<?php echo $sum_post_page?>&page=<?php echo $num?>"><?php echo $num?></a>
              </li>
              <?php
                }  
              }else{
              ?>
              <li class="page-item active">
                <a class="page-link"><?php echo $num?></a>
              </li>
              <?php
                }
              }
              ?>
              <?php
                if($current_page < $totalPages - 1){
                  $next_page=$current_page+1;
                ?>
              <li class="page-item">
                <a class="page-link" href="?web_moc=Tatcabaiviet&id=<?php echo $_GET['id']?>&per-page=<?php echo $sum_post_page?>&page=<?php echo $next_page?>">Next</a>
              </li>
              <?php
                }if($current_page < $totalPages - 2){
                    $end_page=$totalPages;
              ?>
              <li class="page-item">
                <a class="page-link" href="?web_moc=Tatcabaiviet&id=<?php echo $_GET['id']?>&per-page=<?php echo $sum_post_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
              </li>
              <?php
              }
              ?>
            </ul>
          </nav>
        </div>
    </div>
    
    <!-- ================================================ -->
    <div class="col-3">
    <div id="accordion">
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">DANH MỤC SẢN PHẨM</a></div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
              <?php
              $sql_pd= mysqli_query($con, "SELECT * FROM productlines");
              while ($row_pd = mysqli_fetch_array($sql_pd)) {
                ?>
              <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tree-fill" viewBox="0 0 16 16"><path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5z"/></svg>

                <a href="index.php?web_moc=Danhmucsanpham&id=<?php echo $row_pd['productLineCode']?>"><?php echo $row_pd['productLineName']?></a>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">SẢN PHẨM MỚI</a></div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
              <?php
              $sql_sp= mysqli_query($con, "SELECT * FROM products ORDER BY productCode DESC LIMIT 10");
              while ($row_sp = mysqli_fetch_array($sql_sp)) {
                ?>
              <div class="card-body pd_new">
              <a href="index.php?web_moc=Chitietsanpham&idsp=<?php echo $row_sp['productCode']?>">
                  <div class="row">
                      <div class="col-4">
                      <img class="img-thumbnail" src="../admin/image/product/<?php echo $row_sp['productImage']?>" alt="Sản phẩm 1" class="img-responsive" width="100">
                      </div>
                      <div class="col-8">
                      <p><?php echo $row_sp['productName']?></p>
                      <p><?php echo number_format($row_sp['buyPrice']).".000<sup>đ</sup>"?></p>
                    </div>
                  </div>
                  </a>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
        
        
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">BÀI VIẾT MỚI</a></div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
              <?php
              $sql_pt= mysqli_query($con, "SELECT * FROM newpost ORDER BY id_post LIMIT 5");
              while ($row_pt = mysqli_fetch_array($sql_pt)) {
                  
                ?>
              <div class="card-body pt_new">
              <a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_pt['id_post']?>">
                  <div class="row">
                      <div class="col-4">
                      <img class="img-thumbnail" src="../admin/image/post/<?php echo $row_pt['image_post']?>" alt="Sản phẩm 1" class="img-responsive" width="100">
                      </div>
                      <div class="col-8">
                      <p><?php echo $row_pt['name_post']?></p>
                      <p><?php echo $row_pt['date_post']?></p>
                    </div>
                  </div>
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>

        
    </div>
    
    
</div>

  </div>
 
 
</body>
</html>