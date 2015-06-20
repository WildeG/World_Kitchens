<?php
session_start();
?>
<html>
  <head>
    <link rel="shortcut icon" href="http://wildegard.com/image/system/favicon.ico" type="image/x-icon">
    <link href="http://wildegard.com/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://wildegard.com/css/owl.carousel.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Добавить кухню</title>
  </head>
  <body>
    <div id="main">
      <!- Шапка сайта ->
      <div id="hat">       
        <center><a href='http://wildegard.com/index.php'><img src="http://wildegard.com/image/name.png" id="name" title="Перейти на главную"></a></center>
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
                <input type='button' id='button_menu' value='Кухни' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюда' class='no_transparency'>
                <input type='button' id='button_menu' value='Поиск' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюдо дня' class='no_transparency'>
                <a href='add-recipe.php'><input type='button' id='button_menu' value='+Рецепт' class='no_transparency'></a>
                <a href='add-news.php'><input type='button' id='button_menu' value='+Новость' class='no_transparency'></a>
                <input type='button' id='button_menu' value='Поиск' class='no_transparency'>
                <input type='button' id='button_menu' value='Блюдо дня' class='no_transparency'>
              </div>
            </div>";
        } ?>
      <!-Содержимое ->
      <center><table id="registration">
      <caption><img src="http://wildegard.com/image/inscription/add-kitchens.png" id="lenta" /></caption>
        <form action="http://wildegard.com/php/save/save_kitchens.php" method="post" enctype="multipart/form-data">
        <tr><td class="inscriptions">Кухня</td></tr>
        <tr><td><input class="field" type="text" maxlength="40" name="title" ></td></tr>     
        <tr><td class="inscriptions">Изображение*</td></tr>
        <tr><td><input class="button" name="image" type="file" accept="image/jpeg,image/png,image/gif"></td></tr>        
        <tr><td class="inscriptions">* - Помечены не обязательные поля</td></tr>
        <tr><td align="right"><input class="button" type="submit" value="Добавить кухню" name="submit" ></td></tr>
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
    <script src="http://wildegard.com/script/owl.carousel.js"></script>
    <script src="http://wildegard.com/script/owl.carousel.min.js"></script>
    <div id="band" align="right">
      <div id="user"><center>
        <a href='http://wildegard.com/user.php' title="Редактировать информацию о себе"><?php echo "".$_SESSION['family']."&nbsp".$_SESSION['name'].""?></a>
        <a href='http://wildegard.com/exit.php' >(Выход)</a></center>
      </div>
    </div>          
  </body>
</html>
