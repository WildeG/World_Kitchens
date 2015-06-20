<?php include_once("practicBD.php");?>
<html>
  <head>
  <link href="http://wildegard.com/css/practic.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <big>Расписание движения пасажирского транспорта<big><br><img src="image/bus.png" >
    <div id="n1">
    <form action="Practic2.php" method="post" enctype="multipart/form-data">
    <table>
    <tr>
    <td>Временное ограничение</td>
    <td>
    <b>0<input type="range" min="00:01:00" max="00:30:00" step="1" value="6" name="time">30</b>
    </td>
    <td>Конечная точка</td>
    <td>
    <select size="1" name="end" >
      <option class='field_l' value='Выберите остановку'>Выберите остановку</option><br>
      <?php
          $sel = "SELECT * FROM path_1";
          $query = mysql_query($sel);
          if(mysql_num_rows($query)>0){
            while($res = mysql_fetch_array($query)){
              echo "<option class='field_l' value='".$res['End_point']."'>".$res['End_point']."</option><br>";
            }
          }
      ?> 
    </select>
    </td>
    </tr>
    <input class="button" type="submit" value="Поиск маршрута" name="submit" >
    </form>
    </div>
  </body>
</html>