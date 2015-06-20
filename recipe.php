<?php
session_start();
include ('bd.php');

if(isset($_GET['id_recipe'])) {
  $recipe = $_GET['id_recipe'];
  } 
  else {
    $recipe = 3;
  }
$sel = "SELECT * FROM `recipe` WHERE id_recipe=".$recipe;
$query = mysql_query($sel);
$res = mysql_fetch_assoc($query);
?>
<html>
  <head>
    <link href="http://wildegard.com/image/system/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="http://wildegard.com/css/style.css" rel="stylesheet" type="text/css" >
    <link href="http://wildegard.com/css/recipe.css" rel="stylesheet" type="text/css" />
    <link href="http://wildegard.com/css/owl.carousel.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $res['title']; ?></title>
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
                <div>
                  <?php
                    echo "<center><div id='news'>
                          <table id='table_recipe'>
                          <tr>
                          <td colspan='2' align='center'><h2>".$res['title']."</h2></td>
                          </tr>
                          <tr>
                          <td colspan='2'><center><img class='image_recipe' src=".$res['image']."></center><td>
                          </tr>
                          <tr>
                          <td colspan='2' class='inscriptions'><h3>Ингридиенты</h3></td>
                          </tr>";
                    $sel2 = "SELECT * FROM component where id_recipe =".$recipe;
                    $query2 = mysql_query($sel2);
                    while($res2 = mysql_fetch_array($query2)){
                      $sel3 = "SELECT * FROM name_component where id =".$res2['id_component'];
                      $query3 = mysql_query($sel3);
                      $res3 = mysql_fetch_array($query3);
                      echo "<tr><td>".$res3['component']."</td><td>".$res2['quantity']."</td><tr>";
                    }
                    echo "<tr>
                          <td colspan='2' class='inscriptions'><h3>Рецепт</h3></td>
                          </tr>
                          <tr>
                          <td colspan='2'>".$res['recipe']."</td>
                          </tr>
                          </table>
                          <center><script type='text/javascript' src='//yastatic.net/share/share.js' charset='utf-8'></script>
                          <div class='yashare-auto-init' data-yashareL10n='ru' data-yashareType='small' data-yashareQuickServices='vkontakte,facebook,twitter,odnoklassniki,moimir,gplus' data-yashareTheme='counter' data-yashareImage='http://wildegard.com/image/recipe/3e551df3a8276c3b50bf.jpg'></div>
                          Мне нравиться
                          Мне не нравиться
                          <li><input type='button' value='Метка'>
                            <ul> 
                              <li>Хочу приготовить</li> 
                              <li>Приготовил</li> 
                            </ul> 
                          </li><center>
                          </div></center>";?>
                </div>
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
