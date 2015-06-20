<?php
include_once("bd.php");
// ID рецепта - можно передавать через форме
$id_recepiet = 10;
// Список ингридиентов
$components = $_POST;
// Вывести как они выглядят
var_dump($components);
// Основа запроса
$str = "insert into component (id_recipe, id_component) values ";

// Число ингридиентво
$count = count($components);
// Счетчик
$i = 0;

foreach($components as $key => $value) {

   // Вытаскиваем id ингридиента по его имени
   $sql = "SELECT id FROM component WHERE name = {$value['name']}";
   // Выполняем запрос, поулчаем ID
   $id = <request> $sql;
   // Счетчик ингридиентов
   $i++;
   // Дополняем в запрос на добавления новые ингридинты
   $str += "({$id_recipe}, {$id}";
    // Если это не последний ингридиент - добавляем запятую
   if( $count != $i ) {
      $str += ",";
   }
}

// Делаем запрос на добавление
<request> $str

?>