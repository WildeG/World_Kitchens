<?php
session_start();
include ('bd.php');
$link = 'http://world-kitchens.loc/';
$num_elements = 1;

if ((mysql_result(mysql_query("SELECT COUNT(*) FROM `news`"),0,0))>2) {
	$num_elements = 2;
}
$start = mysql_result(mysql_query("SELECT COUNT(*) FROM `news`"),0,0) - $num_elements; //Стартовая позиция выборки из БД
$sel = "SELECT * FROM `kitchens`";
$query = mysql_query($sel);
?>
<html>
	<head>

		<link href=<?php $link ?>"image/system/favicon.ico" rel="shortcut icon" type="image/x-icon">

		<link href=<?php $link ?>"css/style.css" rel="stylesheet" type="text/css" >
		<link href=<?php $link ?>"css/owl.carousel.css" rel="stylesheet">
		<link rel="stylesheet" href=<?php $link ?>"css/homepages.css" type="text/css">

		<script src=<?php $link ?>"script/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src=<?php $link ?>"script/jquery.waterwheelCarousel.min.js" type="text/javascript"></script>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>World Kitchens</title>

	</head>
	<body>
		<div id="main">
			<!-- Шапка сайта -->
			<div id="hat">
<!-- 				<a href="index.php">
				<svg>
				<defs>
					<path id="textpath" fill="none" stroke="#000000" d="M0.057,0.024c0,0,10.99,51.603,102.248,51.603c91.259,0,136.172,53.992,136.172,53.992"/>
				</defs>
				<use xlink:href="#textpath"/>
					<text x="10" y="100">
						<textPath xlink:href="#textpath" font-family="Pacifico">
							World's Kitchens
						</textPath>
					</text>
				</svg>
				</a> -->
				<center><a href="index.php"><h1 title="Перейти на главную">World's Kitchens</h1></a></center>
			</div>
			<?php
			// Проверяем, пусты ли пересменные логина и id пользователя
			if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
				// Если пусты, то мы не выводим ссылку
			}
				else {
					// Если не пусты, то мы выводим ссылку
					echo 
						"<div id='button_panel'>
							<div class='owl-carousel'>
									<ul class='menu'><center>
										<li><input type='button' id='button_menu' value='Добавить'>
											<ul> 
												<li><a href='".$link."add-news.php'>Новость</a></li> 
												<li><a href='".$link."add-recipe.php'>Рецепт</a></li> 
												<li><a href='".$link."php/add/add-kitchens.php'>Кухню</a></li> 
												<li><a href='".$link."php/add/add-component.php'>Ингридиенты</a></li> 
											</ul> 
										</li></center> 
									</ul>
									<ul class='menu'><center>
										<li><input type='button' id='button_menu' value='Кухни'>
											<ul>";
									while($res = mysql_fetch_array($query)){
												echo "<li><a href='".$link."kitchens.php?kitchens=".$res['title']."'>".$res['title']."</a></li>";
											}
						  echo "		</ul> 
									</li></center> 
								</ul>
								<input type='button' id='button_menu' value='Блюда' class='no_transparency'>
								<input type='button' id='button_menu' value='Поиск' class='no_transparency'>
								<input type='button' id='button_menu' value='Блюдо дня' class='no_transparency'>
								<input type='button' id='button_menu' value='Новости' class='no_transparency'>
									<ul class='menu'><center>
										<li><input type='button' id='button_menu' value='Избранное'>
											<ul> 
												<li><a href='".$link."add-news.php'>Хочу приготовить</a></li> 
												<li><a href='".$link."add-recipe.php'>Уже готовил</a></li> 
												<li><a href='".$link."php/add/add-kitchens.php'>Мои рецепты</a></li> 
											</ul> 
										</li></center> 
									</ul>
							</div>
						</div>";
				} ?>
			<!--Содержимое -->
				<center><img src="image/lenta.png"  /></center>
				<div id="carousel">
					<a href="feedback.php"><img src="image/countries/001.jpg" id="item-1" /></a>
					<a href="php/countries/kitchens.php"><img src="image/countries/002.jpg" id="item-2" /></a>
					<a href="php/countries/japanese.php"><img src="image/countries/003.jpg" id="item-3" /></a>
					<a href="#"><img src="image/countries/004.jpg" id="item-4" /></a>
				</div>
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
			var carousel = $("#carousel").waterwheelCarousel({
				flankingItems: 3,
				movingToCenter: function ($item) {
					$('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
				},
				movedToCenter: function ($item) {
					$('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
				},
				movingFromCenter: function ($item) {
					$('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
				},
				movedFromCenter: function ($item) {
					$('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
				},
				clickedCenter: function ($item) {
					$('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
				}
			});
			$('#prev').bind('click', function () {
				carousel.prev();
				return false
			});
			$('#next').bind('click', function () {
				carousel.next();
				return false;
			});
			$('#reload').bind('click', function () {
				newOptions = eval("(" + $('#newoptions').val() + ")");
				carousel.reload(newOptions);
				return false;
			});
		</script>
		<script src="script/owl.carousel.js"></script>
		<script src="script/owl.carousel.min.js"></script>
		<?php
			// Проверяем, пусты ли пересменные логина и id пользователя
			if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
				echo 
"<div id='band'>
<div id='user'>
	 <form method='post' action='testreg.php'>
		<table>
			<tr>
				<td colspan='2'><input type='text' class='verification' size='25' maxlength='25' placeholder='Логин' name='login'></td>
			</tr>
			<tr>
				<td colspan='2'><input type='password' class='verification' size='25' maxlength='25' placeholder='Пароль' name='password'></td>
			</tr>
			<tr>
				<td><input type='submit' name='submit' class='button' value='Вход'></td>
				<td><a href='reg.php'><input type='button' class='button' value='Регистрация'></a></td>
			</tr>              
		</table>
	</form>
</div>
</div>"; }
else {
					// Если не пусты, то мы выводим ссылку
					echo 
		"<div id='band'>
			<div id='user'><center>
				<a href='user.php' title='Редактировать информацию о себе''>".$_SESSION['family']."&nbsp".$_SESSION['name']."</a>
				<a href='exit.php' >(Выход)</a></center>
			</div>
		</div> ";
				} ?>
	</body>
</html>