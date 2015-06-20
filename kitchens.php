<?php
session_start();
include ('bd.php');
include ('php/functions.php');

if(isset($_GET['kitchens'])) {
  $kitchens = $_GET['kitchens'];
} 
else {
  $kitchens = "Русская";
}
if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 5;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `recipe` WHERE kitchens='".$kitchens."'"),0,0); //Подсчет общего числа записей
$num_pages = ceil($total / $num_elements); //Подсчет числа страниц
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Стартовая позиция выборки из БД
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/news.css" />
    <link href="http://wildegard.com/image/system/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="http://wildegard.com/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://wildegard.com/css/owl.carousel.css" rel="stylesheet"/>
    <link href="http://wildegard.com/css/recipe.css" rel="stylesheet"/>
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
                  $sel = "SELECT * FROM `recipe` WHERE kitchens='".$kitchens."' LIMIT ".$start.", ".$num_elements;
                  $query = mysql_query($sel);
                    if(mysql_num_rows($query)>0){ 
                      echo "<br><div><center><h2><b>".$kitchens." кухня</h2>";                                
                      while($res = mysql_fetch_array($query)){
                        echo "
                          <div id='recipe'>
                          <img align='left' class='image_recipe_mini' src=".$res['image']." />
                          <h4>".$res['title']."</h4>
                          <table id='table_recipe'>
                            <tr>
                              <td align='left'><a class='subtitle'>Автор:&nbsp".$res2['name']."&nbsp".$res2['family']."</a></td>
                              <td align='right'><a class='subtitle'>".$res['date_added']."</a></td>
                            </tr>
                            <tr>
                              <td colspan='2'><a id='contents'>".join(' ', array_slice(explode( ' ', $res['recipe'] ), 0, 15))."...</a></td>
                            </tr>
                            <tr>
                              <td>
                                <img align='left' class='icon_mini' src='http://wildegard.com/image/system/like.png' />
                                <img align='left' class='icon_mini' src='http://wildegard.com/image/system/dislike.png' />
                              </td>
                              <td align='right'><a href='recipe.php?id_recipe=".$res['id_recipe']."'>Читать далее...</a></td>
                            </tr>
                          </table>
                          </div>";
                      }
                    }?>
                  <a href="kitchens.php?page=2&kitchens=Французская"><<</a>
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
var counter = <?php echo $i ?>;
        $("#add-contact").click(function(){
            $("#contacts").append('<div style="margin-bottom:10px" class="form-inline"><input type="text" name="contacts['+counter+'][post]" value="" class="form-control post" placeholder="Должность" style="height:34px;width:145px;margin-right:5px" /><input type="text" name="contacts['+counter+'][name]" value="" class="form-control name" placeholder="Имя" style="height:34px;width:145px;margin-right:5px" /><input type="text" name="contacts['+counter+'][phone]" value="" class="form-control phone" placeholder="Телефон" style="height:34px;width:145px;margin-right:5px" /></div>');
            counter++;
        })


 <?php
echo Form::label('contacts', '<h5>Контаты</h5>');
echo "<div id='contacts'>";
$blocks = explode('|', $performer->contacts);
$count = count($blocks);
$i = 0;
for ($i = 0; $i < $count; $i++) {
    echo '<div style="margin-bottom:10px" class="form-inline">';
    $parts = explode(';', $blocks[$i]);
    $post  = $parts[0];
    $name  = $parts[1];
    $phone = $parts[2];
    echo Form::input("contacts[{$i}][post]" , $post , array('class' => 'form-control post' , 'placeholder' => 'Должность' , 'style' => 'height:34px;width:145px;margin-right:5px')) .
         Form::input("contacts[{$i}][name]" , $name , array('class' => 'form-control name' , 'placeholder' => 'Имя' , 'style' => 'height:34px;width:145px;margin-right:5px')) .
         Form::input("contacts[{$i}][phone]", $phone, array('class' => 'form-control phone', 'placeholder' => 'Телефон' , 'style' => 'height:34px;width:145px;margin-right:5px'));
    echo '</div>';
}
echo "</div>";
// должность;имя;телефон|должность;имя;телефон
?>


<span id="add-contact" title="Добавить контакт" ><b>Добавить контакт&nbsp&nbsp</b><span class="glyphicon glyphicon-plus"></span></span>
<br>
