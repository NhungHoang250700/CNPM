<?php
include '../db/config.php';
// lấy ra tên sản phẩm, tính tổng số lượng sản phẩm đã đặt hàng theo productCode từ bảng products và orderdetails điều kiện mã sản phẩm của bảng product bằng với mã sản phẩm bảng orderdetails gom nhóm theo productCode
$sql_sum_product=mysqli_query($con, "SELECT A.productName, sum(B.quantityOrder) as quantity FROM products A, orderdetails B WHERE A.productCode=B.productCode GROUP BY B.productCode");
$data=[];
while($row=mysqli_fetch_array($sql_sum_product)){
    $data[]=$row;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thống kê</title>
</head>
<body>

 <div class="bar">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['productName', 'quantity'],
          <?php
          foreach ($data as $key) {
            echo "['" .$key['productName']. "',".$key['quantity']."],";

          }
          ?>
          
        ]);

        var options = {
          title: 'SẢN PHẨM ƯU THÍCH',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  
    <div id="piechart_3d" style="width: 1250px; height: 400px;"></div>
 
  </div>




    
  <head>
      
      <?php
      // Lấy ngày, tính tổng đơn hàng theo ngày tháng từ bảng order, orderdetails, products điều kiện A.orderNumber = B.orderNumber And B.productCode=C.productCode và orderDate lớn hơn (ngày hiện tại trừ đi 1 tuần ) gom nhóm thẻo ngày, tháng của orderDate
      $sql_sum_price=mysqli_query($con, "SELECT date(A.orderDate) as ngay, sum(B.quantityOrder * C.buyPrice) as total FROM orders A, orderdetails B, products C where A.orderNumber = B.orderNumber And B.productCode=C.productCode AND A.orderDate > subdate(Now(), interval 1 week) GROUP BY day(A.orderDate), month(A.orderDate)");
      $data_price=[];
      while($row_price=mysqli_fetch_array($sql_sum_price)){
          $data_price[]=$row_price;
      }
      ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ngày', 'Tổng hóa đơn'],
          <?php
          foreach ($data_price as $key) {
            echo "['" .$key['ngay']. "',".$key['total']."],";

          }
          ?>
         
        ]);

        var options = {
          title: 'Doanh thu tuần qua',
          hAxis: {title: 'Tuần',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 1250px; height: 500px;"></div>
  </body>



  
</body>
</html>






