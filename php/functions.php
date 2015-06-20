<?php
function GetNav($p, $num_pages){

//Проверяем нужна ли ссылка "На первую"
  if($p > 2){
    $first_page = ' <a href="/php/countries/japanese.php?page=1"><<</a> ';   //или просто $first_page = ' <a href="/index.php"><<</a> ';
  }
  else{
    $first_page = '';
  }

//Проверяем нужна ли ссылка "На последнюю"
  if($p < ($num_pages - 2)){
    $last_page = ' <a href="/php/countries/japanese.php?page='.$num_pages.'">>></a> ';
  }
  else{
    $last_page = '';
  }

//Проверяем нужна ли ссылка "На предыдущую"
  if($p > 1){
    $prev_page = ' <a href="/php/countries/japanese.php?page='.($p - 1).'"><</a> ';
  }
  else{
    $prev_page = '';
  }

//Проверяем нужна ли ссылка "На следущую"
  if($p < $num_pages){
    $next_page = ' <a href="/php/countries/japanese.php?page='.($p + 1).'">></a> ';
  }
  else{
    $next_page = '';
  }

//Формируем по 2 страницы до и после текущей (при наличии таковых, конечно):
  if($p - 2 > 0){
    $prev_2_page = ' <a href="/php/countries/japanese.php?page='.($p - 2).'">'.($p - 2).'</a> ';
  }
  else{
    $prev_2_page = '';
  }
  if($p - 1 > 0){
    $prev_1_page = ' <a href="/php/countries/japanese.php?page='.($p - 1).'"> '.($p - 1).' </a> ';
  }
  else{
    $prev_1_page = '';
  }
  if($p + 2 <= $num_pages){
    $next_2_page = ' <a href="/php/countries/japanese.php?page='.($p + 2).'"> '.($p + 2).' </a> ';
  }
  else{
    $next_2_page = '';
  }
  if($p + 1 <= $num_pages){
    $next_1_page = ' <a href="/php/countries/japanese.php?page='.($p + 1).'">'.($p + 1).'</a> ';
  }
  else{
    $next_1_page = '';
  }
  $nav = $first_page.$prev_page.$prev_2_page.$prev_1_page.$p.$next_1_page.$next_2_page.$next_page.$last_page;
  return $nav;
}
?>