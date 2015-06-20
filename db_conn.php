<?php
  $dbase=mysql_connect('localhost', 'root', '');
  $db = mysql_connect ("localhost","root","");
  if(!$dbase){
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Не могу подключиться к БД</title>
</head>
<body>
  <br /><br /><br />
  <h1 align="center">Проверьте настройки подключения к БД</h1>
</body>
</html>
<?php
  exit;
  }
  mysql_select_db('world_k',$db);
  @mysql_query('set character_set_client="utf8"');
  @mysql_query('set character_set_results="utf8"');
  @mysql_query('set collation_connection="utf8_general_ci"');
?>
