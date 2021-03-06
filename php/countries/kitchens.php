<?php
session_start();
?>
<html>
  <head>
    <link href="http://wildegard.com/image/system/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="http://wildegard.com/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://wildegard.com/css/owl.carousel.css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Добавить рецепт</title>
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
                        $sel = "SELECT * FROM `news` LIMIT ".$start.", ".$num_elements;
                        $query = mysql_query($sel);
                        if(mysql_num_rows($query)>0){
                                ?><br><div>
                                <?php
                                while($res = mysql_fetch_array($query)){
                                $sel2 = "SELECT * FROM users where id =".$res['id_autors']."";
                                $query2 = mysql_query($sel2);
                                $res2 = mysql_fetch_array($query2);                 
                                    echo "<center><h2><b>Новости</h2><div id='news'>
                                            <img align='left' class='image_news' src=".$res['image']." />
                                            <h4>".$res['title']."</h4>
                                            <table id='table_news'>
                                                <tr>
                                                    <td align='left'><a class='subtitle'>Автор:&nbsp".$res2['name']."&nbsp".$res2['family']."</a></td>
                                                    <td align='right'><a class='subtitle'>".$res['date_added']."</a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'><a id='contents'>".join(' ', array_slice(explode( ' ', $res['texts'] ), 0, 15))."...</a></td>
                                                </tr>
                                            </table>
                                            </div></center>";
                                }
                                ?>
                                </div>
                                <?php
                        }
                    ?>
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
