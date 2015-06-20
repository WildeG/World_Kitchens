<?php
  session_start();
  include_once("bd.php");
  if (empty($_FILES['image']['name'])){
    $newsimage = 'http://wildegard.com/image/news/default.jpg'; 
  }
    else {
      $path = 'image/news';  
      if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['image']['name'])){
        $extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20);
        $target = $path . '/' . $filename . '.' . $extension;
        $newsimage = 'http://wildegard.com/'. $path . '/' . $filename . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
      }
    }
  if (isset($_POST['submit'])){
    if(empty($_POST['title'])){
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите заголовок!</font>';
    }
    elseif(empty($_POST['text'])){
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите содержание!</font>';
    }
    else{
        $title = $_POST['title'];
        $texts = $_POST['text'];
        
        $id_autors = $_SESSION['id'];
        $date_added = date("Y-m-d");
  			
        $query_login = ("SELECT title FROM news WHERE title='$title'");
        $sql = mysql_query($query_login) or die(mysql_error());
  			
        if (mysql_num_rows($sql) > 0){
        	echo '<font color="red"><img border="0" src="error.gif" align="middle"> Такой заголовок уже существует!</font>';
        	}
        	else{
				$query = "INSERT INTO news (title, texts, id_autors, date_added, image )
            	VALUES ('$title', '$texts', '$id_autors', '$date_added', '$newsimage')";
            	$result = mysql_query($query) or die(mysql_error());
            	echo '<font color="green"><img border="0" src="ok.gif" align="middle"> Новость успешно добавлена!</font><br><a href="index.php">На главную</a>';  								
            }
        }
  }
 ?>