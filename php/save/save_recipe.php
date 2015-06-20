<?php
  session_start();
  include_once("../../bd.php");

  if (empty($_FILES['image']['name'])){
    $recipeimage = 'http://wildegard.com/image/recipe/default.jpg';
  }
    else {
      $path = 'http://wildegard.com/image/recipe';
      if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['image']['name'])){
        $extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20);
        $target = $path . '/' . $filename . '.' . $extension;
        $recipeimage = $path . '/' . $filename . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
      }
    }
  if (isset($_POST['submit'])){
    if(empty($_POST['title'])){
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите название рецепта!</font>';
    }
    elseif(empty($_POST['recipe'])){
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите сам рецепт!</font>';
    }
    else{
        $title = $_POST['title'];
        $recipe = $_POST['recipe'];
        $id_autors = $_SESSION['id'];
        $date_added = date("Y-m-d");
  			$kitchens = $_POST['kitchens'];

        $query_login = ("SELECT title FROM recipe WHERE title='$title'");
        $sql = mysql_query($query_login) or die(mysql_error());

        if (mysql_num_rows($sql) > 0){
        	echo '<font color="red"><img border="0" src="error.gif" align="middle"> Данный рецепт уже существует!</font>';
        	}
        	else{
				      $query = "INSERT INTO recipe (title, id_autors, recipe, image, date_added, kitchens )
            	VALUES ('$title', '$id_autors', '$recipe', '$recipeimage', '$date_added', '$kitchens' )";
            	$result = mysql_query($query) or die(mysql_error());
              // Ингридиенты
              $id_recipe = mysql_insert_id();
              $components = $_POST['parts'];
              $quantity = $_POST['quantity'];
              $str = "insert into component (id_recipe, id_component, quantity) values ";
              $count = count($components);
              $i = 0;
              foreach($components as $key => $value) {
                $sql = "SELECT id FROM name_component WHERE component = '$value'";
                $sqlresult = mysql_query($sql) or die(mysql_error());
                $result = mysql_fetch_object($sqlresult);
                $i++;
                
                  $str .= "({$id_recipe},{$result->id},'{$quantity[$i]}')";
                  if( $count != $i ) {
                    $str .= ",";
                  }
                
              }
              // Insert ингридиенты
              mysql_query($str) or die(mysql_error());
            	echo '<font color="green"><img border="0" src="ok.gif" align="middle"> Рецепт успешно добавлен!</font><br><a href="index.php">На главную</a>';
              }
              
        }
  
}
?>