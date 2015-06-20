<?php
session_start();
?>
<html>
  <head>
    <link rel="shortcut icon" href="image/system/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/addnews.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Добавить новость</title>
  </head>
  <body>
    <div id="main">
      <!- Шапка сайта ->
      <div id="hat">       
        <center><a href='index.php'><img src="image/name.png" id="name" title="Перейти на главную"></a></center>
      </div>
      <?php
      // Проверяем, пусты ли пересменные логина и id пользователя
      if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
        // Если пусты, то мы не выводим ссылку
        header('Location:http://wildegard.com/index.php');
      }
        else {
          // Если не пусты, то мы выводим ссылку
          echo 
            "<div id='button_panel'>
              <div class='owl-carousel'>
                  <ul class='menu'><center>
                    <li><input type='button' id='button_menu' value='Добавить'>
                      <ul> 
                        <li><a href='http://wildegard.com/add-news.php'>Новость</a></li> 
                        <li><a href='http://wildegard.com/add-recipe.php'>Рецепт</a></li> 
                        <li><a href='http://wildegard.com/php/add/add-kitchens.php'>Кухню</a></li> 
                        <li><a href='http://wildegard.com/php/add/add-component.php'>Ингридиенты</a></li> 
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
      <!-Содержимое ->
      <center>
      <table id="addnews">
      <caption><img src="image/inscription/add-news.png" id="lenta" /></caption>
        <form action="php/save/save_news.php" method="post" enctype="multipart/form-data">
        <tr><td class="inscriptions">Заголовок</td></tr>
        <tr><td><input class="field" type="text" maxlength="40" name="title" ></td></tr>
        <tr class="inscriptions"><td>Содержание</td></tr>
        <tr><td><textarea class="field" maxlength="16600" name="text"></textarea></td></tr>       
        <tr><td class="inscriptions">Изображение*</td></tr>
        <tr><td><input class="button" name="image" type="file" accept="image/jpeg,image/png,image/gif"></td></tr>       
        <tr><td class="inscriptions">* - Помечены не обязательные поля</td></tr>
        <tr><td align="right"><input class="button" type="submit" value="Добавить новость" name="submit" ></td></tr>
        <br></form>
      </table></center>
      <!- Подвал ->
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
