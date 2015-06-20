<?php
session_start();
include_once("bd.php");
$link = 'http://world-kitchens.com/';
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
        header('Location:'.$link.'.com/index.php');
      }
        else {
          // Если не пусты, то мы выводим ссылку
          echo
            "<div id='button_panel'>
              <div class='owl-carousel'>
                  <ul class='menu'><center>
                    <li><input type='button' id='button_menu' value='Добавить'>
                      <ul>
                        <li><a href='".$link.".com/add-news.php'>Новость</a></li>
                        <li><a href='".$link.".com/add-recipe.php'>Рецепт</a></li>
                        <li><a href='".$link.".com/php/add/add-kitchens.php'>Кухню</a></li>
                        <li><a href='".$link.".com/php/add/add-component.php'>Ингридиенты</a></li>
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

            <center><h2><b>Добавить рецепт</h2>
                <center><form action="test-form.php" method="post" enctype="multipart/form-data">
                <div>
                    <div id="name_recipe">
                        Название<br>
                        <input class="field" type="text" maxlength="40" name="title" >
                    </div>
                    <div id="kitchens">
                        Кухня<br>
                        <?php
                            $num_elements = 4;
                            $start = 0;
                            $sel = "SELECT * FROM `kitchens` LIMIT ".$start.", ".$num_elements;
                            $query = mysql_query($sel);
                            if(mysql_num_rows($query)>0){
                                while($res = mysql_fetch_array($query)){
                                  echo "<input type='radio' name='kitchens' value='".$res['title']."'>".$res['title']."<br>";
                                }
                              }
                        ?>
                    </div>
                    <div id="component">
                        Ингридиенты
                        <div id="name_component">
                            Название ингридиента<br>
                            <a><select name="parts[0][name]">
                                <option class='field_l' value='Выбирете ингридиент'>Выбирете ингридиент</option>
                                <?php
                                    $sel = "SELECT * FROM `name_component`";
                                    $query = mysql_query($sel);
                                    if(mysql_num_rows($query)>0){
                                      while($res = mysql_fetch_array($query)){
                                        echo "<option class='field_l' value='".$res['component']."'>".$res['component']."</option>";
                                      }
                                    }
                                ?> 
                            </select><br></a>
                        </div>
                        <div id="count_component">
                            Колличество<br>
                            <a><input type='text' name='parts[0][count]'><br></a>
                        </div>
                        <input id="add-component" class="button" type="button" value="Добавить" >
                        <input id="remove-component" class="button" type="button" value="Удалить" >
                    </div>
                    <div id="recipe">
                        Рецепт<br>
                        <textarea class="field" maxlength="16600" name="recipe"></textarea>
                    </div>
                    <div id="image">
                        Изображение*<br>
                        <input class="button" name="image" type="file" accept="image/jpeg,image/png,image/gif">
                    </div>
                    * - Помечены не обязательные поля<br>
                    <input class="button" type="submit" value="Добавить рецепт" name="submit" >
                </div>
                </form></center>
        </center>
        <script>
            var counter = 1;
            $("#add-component").click(function(){
                $("<a><select name='parts["+counter+"][name]'></select><br></a>").appendTo("#name_component");
                $("<a><input type='text' name='parts["+counter+"][count]'><br></a>").appendTo("#count_component");
                counter++;
            });
            $("#remove-component").click(function(){
              $("#count_component a:last-child").remove()
              $("#name_component a:last-child").remove()
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