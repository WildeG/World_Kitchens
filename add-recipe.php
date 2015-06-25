<?php
session_start();
include_once("bd.php");
$link = 'http://world-kitchens.loc/';
?>
<html>
  <head>
    <link href=<?php $link ?>"image/system/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href=<?php $link ?>"css/style.css" rel="stylesheet" type="text/css" />
    <link href=<?php $link ?>"css/addrecipe.css" rel="stylesheet" type="text/css" />
    <link href=<?php $link ?>"css/owl.carousel.css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Добавить рецепт</title>
  </head>
  <body>
    <div id="main">
      <!-- Шапка сайта -->
      <div id="hat">
        <center><a href='index.php'><img src=<?php $link ?>"image/name.png" id="name" title="Перейти на главную"></a></center>
      </div>
      <?php
      // Проверяем, пусты ли пересменные логина и id пользователя
      if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
        // Если пусты, то мы не выводим ссылку
        header('Location:'.$link.'index.php');
      }
        else {
          // Если не пусты, то мы выводим ссылку
          echo
            "<div id='button_panel'>
              <div class='owl-carousel'>
                  <ul class='menu'><center>
                    <li><input type='button' id='button_menu' value='Добавить'>
                      <ul>
                        <li><a href='".$link."add-news.php'>Новость</a></li>
                        <li><a href='".$link."add-recipe.php'>Рецепт</a></li>
                        <li><a href='".$link."php/add/add-kitchens.php'>Кухню</a></li>
                        <li><a href='".$link."php/add/add-component.php'>Ингридиенты</a></li>
                      </ul>
                    </li></center>
                  </ul>
                <input type='button' id='button_menu' value='Кухни' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюда' class='no_transparency'>
                <input type='button' id='button_menu' value='Поиск' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюдо дня' class='no_transparency'>
                <input type='button' id='button_menu' value='Поиск' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюдо дня' class='no_transparency'>
              </div>
            </div>";
        } ?>
      <!--Содержимое -->
            <center><h2>Добавить рецепт</h2>
                <center><form action="test-form.php" method="post" enctype="multipart/form-data">
                <div>
                    <div class="blok" style="margin-bottom: 0px;">
                        <a class="inscriptions">Название</a><br>
                        <input class="field_rec" type="text" maxlength="40" name="title" style='width: 550px;' placeholder='Введите название рецепта' >
                    </div>
                    <table style="text-align:center;">
                    <tr>
                    <td>
                        <div id="news">
                          <div class="block_min">
                              <a class="inscriptions">Кухня</a><br>
                              <select name="kitchens" class='field_l' style="width: 235px;">
                              <?php
                                  $num_elements = 4;
                                  $start = 0;
                                  $sel = "SELECT * FROM `kitchens` LIMIT ".$start.", ".$num_elements;
                                  $query = mysql_query($sel);
                                  if(mysql_num_rows($query)>0){
                                      while($res = mysql_fetch_array($query)){
                                           echo "<option value='".$res['title']."'>".$res['title']."</option>";
                                      }
                                    }
                              ?>
                              </select><br>
                          </div>
                          </td><td>
                          <div class="block_min">
                            <a class="inscriptions">Изображение<sup>*</sup></a><br>
                            <input class="inscriptions_min" name="image" type="file" accept="image/jpeg,image/png,image/gif">
                            <br><a class='inscriptions_min'>Необязательное поле</a><br>
                          </div>
                          
                      </div>
                      <td>
                     </tr>         
                    </table>
                    <div class="blok">
                        <input id="add-component" class="plus" type="button" value="+" ><a class="inscriptions">Ингридиенты</a><input id="remove-component" class="plus" type="button" value="-" >
                        <table style='text-align:center'>
                        <tr>
                        <td id="name_component">
                            <strong class='inscriptions_min'>Название ингридиента</strong><br>
                            <p><select name="parts[0][name]" class='field_l'>
                                <option value='Выбирите ингридиент'>Выбирите ингридиент</option>
                                <?php
                                    $sel = "SELECT * FROM `name_component`";
                                    $query = mysql_query($sel);
                                    if(mysql_num_rows($query)>0){
                                      $test = "";
                                      while($res = mysql_fetch_array($query)){
                                        $test .= "<option value='".$res['component']."'>".$res['component']."</option>";
                                      }
                                      echo $test;
                                    }
                                ?>
                                </select></p>
                        </td> 
                        <td>
                        <div id="count_component">
                            <strong class='inscriptions_min'>Колличество</strong><br>
                            <p><input class='field_r' type='text' name='parts[0][count]' placeholder='Введите колличество'></p>
                        </div>
                        </div></td>
                        </tr></table>
                    </div>   
                    <div class="blok">
                        <a class="inscriptions">Рецепт</a><br>
                        <textarea class="field_rec" maxlength="16600" name="recipe" style='width: 550px;' placeholder='Введите рецепт приготовления'></textarea>
                    </div>
                    <input id="add_button" type="submit" value="Добавить рецепт" name="submit" >
                </div>
                </form></center>
        </center>
        <script>
            var counter = 1;
            $("#add-component").click(function(){
                $("<p><select class='field_l' name='parts["+counter+"][name]'><option value='Выбирете ингридиент'>Выбирете ингридиент</option><?php echo $test; ?></select></p>").appendTo("#name_component");
                $("<p><input class='field_r' type='text' name='parts["+counter+"][count]' placeholder='Введите колличество'></p>").appendTo("#count_component");
                counter++;
            });
            $("#remove-component").click(function(){
              $("#name_component p:last-child").remove()
              $("#count_component p:last-child").remove()
            });
        </script>
<!-- Подвал -->
      <center><br><br><div id="copyright">
      <strong>&copy 2015. Михайлов Олег. Все права защищены.</strong>
      <p>Копирование материалов и использование их в любой форме, в том
      числе и в электронных СМИ, возможны только с письменного разрешения
      администрации сайта. При этом ссылка на сайт обязательна.</p>
      </div></center>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.owl-carousel').owlCarousel();
      });
    </script>
    <script src="script/owl.carousel.js"></script>
    <script src="script/owl.carousel.min.js"></script>
    <div id="band" align="right">
      <div id="user"><center>
        <a href='user.php' title="Редактировать информацию о себе"><?php echo "".$_SESSION['family']."&nbsp".$_SESSION['name'].""?></a>
        <a href='exit.php' >(Выход)</a></center>
      </div>
    </div>
  </body>
</html>