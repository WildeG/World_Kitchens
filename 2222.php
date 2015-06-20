<?php
//подключаемся к базе данных с созданной таблицей и записями
$conn = new mysqli('localhost', 'root', '', 'example');
      
$from = 0; //позиция с которой начинается чтение статей из бд
$col_article = 5; //количество статей, которое будет выводиться на одной странице
$to = $from + $col_article; //до какой записи считывать базу данных

//если указаны $_GET['from'] и $_GET['to']
if(isset ($_GET['from']) && isset ($_GET['to']))
{
    //присваиваем значения переданные по $_GET нашим переменным
    $from = $_GET['from'];
    $to = $_GET['to'];
}
    
//узнаем количество записей в интересующей нас таблице
$col = $conn->query("select * from article"); 
$colich_record = $col->num_rows;

//вычисляем количество страниц, т.е. количеств записей делим на количество статей на страницу
$col_str = $colich_record / $col_article;

//достаем данные из таблицы статей с $from до $to
$result = $conn->query("SELECT * FROM article limit $from, $to"); //limit с какой строки, по какую выводить

//выводим цифры для навигации по страницам
echo "<center>";
for($j = 0; $j < $col_str; $j++)
{
    //вычисляем номер страницы
    $number = $j + 1;
    //вычисляем следующее значении $from
    $new_from = $j*$col_article;
    //вычисляем следующее значение $to
    $new_to = $new_from + $col_article;
    //создаем ссылку и записываем в ее параметры новые from и to с текстом $number
    echo '<a href="../index.php?from='.$new_from.'&to='.$new_to.'">'.$number.' </a>';
}
echo "</center>";

//выводим статьи с $to по $from
for($i = 0; $i < ($to - $from); $i++)
{
    $row = $result->fetch_object();
    
    echo "<center>".$row->article_title."</center>";
    echo "<center>".$row->article_text."</center>";
}