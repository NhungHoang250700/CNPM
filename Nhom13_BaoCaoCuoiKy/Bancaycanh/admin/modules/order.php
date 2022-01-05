<?php
include '../db/config.php';
  //Sửa
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM orders WHERE orderNumber='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/order.css"></link>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
</head>
<body>
    <div class="container-fluid">
        <h5>Đơn hàng</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row input_content">



                <!-- ===================Search======================= -->

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_order_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_order_page;
                    $sql_select_order = mysqli_query($con,"SELECT A.*, B.*, concat(B.lastName,' ',B.firstName) as Name FROM orders A, customerorders B WHERE A.id_customerorder=B.id_customerorder AND B.id_customerorder like '%$tukhoa%' ORDER BY orderNumber DESC LIMIT $sum_order_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM orders WHERE orderNumber like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_order_page);
                    ?>
                    <a href="index_admin.php?admin_moc=Donhang" class="btn btn-warning" id="return"><i class="fa fa-angle-left"></i> Trở lại</a>


                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th style="width:50px"><input id="check_all" type="checkbox"></th>
                            <th style="width:50px">ID</th>
                            <th style="width:150px">Mã khách hàng</th>
                            <th>Tên</th>
                            <th style="width:250px">Ngày đặt</th>
                            <th class="hidden-sm hidden-xs">Ghi chú</th>
                            <th  style="width:100px">Hủy đơn</th>
                            <th style="width:100px">Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_order = mysqli_fetch_array($sql_select_order)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                        <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_order['id_customerorder']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_order['Name']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_order['orderDate']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_order['comment']?></td>

                            <td>
                                <?php if(($row_order['status'])==1){ echo "<i class='fa fa-close' style='color:red'></i>"; }else{echo "<i class='fa fa-check' style='color:green'></i>";}?>
                            </td>
                            <td>

                            <a href="index_admin.php?admin_moc=Chitiethoadon&idhd=<?php echo $row_order['orderNumber']?>"><button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                            <a href="?admin_moc=Donhang&xoa=<?php echo $row_order['orderNumber']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                            </td>
                        </tr>
                        
                    </tbody>
                    <?php
                    }
                    ?>
                </table>


                    <?php
                }else{
                    ?>
                <?php
                    $sum_order_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_order_page;
                    $sql_select_order = mysqli_query($con,"SELECT A.*, B.*, concat(B.lastName,' ',B.firstName) as Name FROM orders A, customerorders B WHERE A.id_customerorder =B.id_customerorder ORDER BY A.orderDate DESC LIMIT $sum_order_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM orders");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_order_page);

                    ?>
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th  style="width:50px"><input id="check_all" type="checkbox"></th>
                            <th  style="width:50px">ID</th>
                            <th style="width:150px">Mã khách hàng</th>
                            <th>Tên</th>
                            <th style="width:250px">Ngày đặt</th>
                            <th class="hidden-sm hidden-xs">Ghi chú</th>
                            <th  style="width:100px">Hủy đơn</th>
                            <th  style="width:100px">Sửa</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_order = mysqli_fetch_array($sql_select_order)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_order['id_customerorder']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_order['Name']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_order['orderDate']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_order['comment']?></td>

                            <td>
                                <?php if(($row_order['status'])==1){ echo "<i class='fa fa-close' style='color:red'></i>"; }else{echo "<i class='fa fa-check' style='color:green'></i>";}?>
                            </td>
                            <td>

                            <a href="index_admin.php?admin_moc=Chitiethoadon&idhd=<?php echo $row_order['orderNumber']?>"><button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                            <a href="?admin_moc=Donhang&xoa=<?php echo $row_order['orderNumber']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                            </td>
                        </tr>
                        
                    </tbody>
                    <?php
                    }
                    ?>
                </table>

                    <?php
                }
                    ?>

                
                
                <!-- ======================Pagination=================== -->
                <nav aria-label="..." class ="pagina-button">
                    <ul class="pagination">
                        <?php
                        if($current_page > 2){
                            $fist_page=1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Donhang&per-page=<?php echo $sum_order_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Donhang&per-page=<?php echo $sum_order_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Donhang&per-page=<?php echo $sum_order_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Donhang&per-page=<?php echo $sum_order_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Donhang&per-page=<?php echo $sum_order_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
                                    </li>
                                    <?php
                                    }
                                    ?>
                    </ul>
                </nav>

            </div>
        </div>

    </div>
 </div>
    
</body>
</html>