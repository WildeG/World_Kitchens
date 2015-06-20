<?php
include ('../../bd.php');
include ('../../php/functions.php');
session_start();

if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 4;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `news`"),0,0); //Подсчет общего числа записей
$num_pages = ceil($total / $num_elements); //Подсчет числа страниц
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Стартовая позиция выборки из БД
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../../css/news.css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Реализация постраничногго вывода информации</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
<body>
<div id="page">
    <div id="header">
    </div>
    <div id="menu">
    </div>
    <div id="content">
        <h1>Наши пользователи</h1>
        <?php
            echo GetNav($p, $num_pages);
            $sel = "SELECT * FROM `news` LIMIT ".$start.", ".$num_elements;
            $query = mysql_query($sel);
            if(mysql_num_rows($query)>0){
                ?><br><div>
                <?php
                while($res = mysql_fetch_array($query)){
           			$sel2 = "SELECT * FROM users where id =".$res['id_autors']."";
            		$query2 = mysql_query($sel2);
            		$res2 = mysql_fetch_array($query2);               	
                	echo "<div id='news'>
                			<img align='left' class='image_news' src=".$res['image']." />
                			<h4>".$res['title']."</h4>
                			<table>
                				<tr>
                					<td align='left'><a class='subtitle'>Автор:&nbsp".$res2['name']."&nbsp".$res2['family']."</a></td>
                					<td align='right'><a class='subtitle'>".$res['date_added']."</a></td>
                				</tr>
                				<tr>
                					<td colspan='2'><a id='contents'>".join(' ', array_slice(explode( ' ', $res['texts'] ), 0, 15))."...</a></td>
                				</tr>
                			</table>
                		  </div>";
                }
                ?>
                </div>
                <?php
            }
        ?>
    </div>
    <div class="clear"></div>
    <div id="footer">
        <p>&copy; Некая информация</p>
    </div>
</div>
</body>
</html>