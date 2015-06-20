<?php 
include_once("practicBD.php");

$start = $_POST['end']; 
$time = $_POST['time'];?>
<html>
  <head>
  <link href="http://wildegard.com/css/practic.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <big>Расписание движения пасажирского транспорта<big><br><img src="image/bus.png" >
    <div id="n1">

<table border="3px">
<tr><td>Начальная станция</td><td>Конечная станция</td><td>Время</td></tr>
      <?php
          $sel = "SELECT * FROM path_1 WHERE End_point='".$start."'";
          $query = mysql_query($sel);
          if(mysql_num_rows($query)>0){
            while($res = mysql_fetch_array($query)){
              echo "<tr><td>".$res['Starting_point']."</td><td>".$res['End_point']."</td><td>".$res['Time']."</td></tr>";
            }
          }
      ?> 
</table>

    </div>
  </body>
</html>