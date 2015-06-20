<?php
  session_start();
  include_once("../../bd.php");
  if (empty($_FILES['image']['name'])){
    $kitchensimage = 'http://wildegard.com/image/countries/default.jpg'; 
  }
    else {
      $path = '../../image/countries';  
      if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['image']['name'])){
        $extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20);
        $target = $path . '/' . $filename . '.' . $extension;
        $kitchensimage = 'http://wildegard.com/image/countries/' . $filename . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
      }
    }
  if (isset($_POST['submit'])){
    if(empty($_POST['title'])){
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите название кухни!</font>';
    }
    else{
        $title = $_POST['title'];
        
        $query_login = ("SELECT title FROM kitchens WHERE title='$title'");
        $sql = mysql_query($query_login) or die(mysql_error());
        
        if (mysql_num_rows($sql) > 0){
          echo '<font color="red"><img border="0" src="error.gif" align="middle"> Данная кухня уже создана!</font>';
          }
          else{
        $query = "INSERT INTO kitchens (title, image )
              VALUES ('$title', '$kitchensimage')";
              $result = mysql_query($query) or die(mysql_error());
              echo '<font color="green"><img border="0" src="ok.gif" align="middle"> Кухня успешно добавлена!</font><br><a href="http://wildegard.com/index.php">На главную</a>';                  
            }
        }
  }
 ?>