<?php
  include_once("bd.php");
  if (isset($_POST['submit'])){
    if(empty($_POST['login']))  {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите логин! </font>';
    }
    elseif (!preg_match("/^\w{3,16}$/", $_POST['login'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> В поле "Логин" введены недопустимые символы! Только буквы, цифры и подчеркивание!</font>';
    }
    elseif(empty($_POST['password'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите пароль!</font>';
    }
    elseif (!preg_match("/\A(\w){6,16}\Z/", $_POST['password'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Пароль слишком короткий! Пароль должен быть не менее 6 символов! </font>';
    }
    elseif(empty($_POST['password_repeat'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите подтверждение пароля!</font>';
    }
    elseif($_POST['password'] != $_POST['password_repeat']) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введенные пароли не совпадают!</font>';
    }
    elseif(empty($_POST['name'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите имя!</font>';
    }
    elseif (!preg_match("/^\w/", $_POST['name'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> В поле "Имя" введены недопустимые символы! </font>';
    }
    elseif(empty($_POST['lastname'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> Введите фамилию!</font>';
    }
    elseif (!preg_match("/^\w/", $_POST['lastname'])) {
      echo '<br><font color="red"><img border="0" src="error.gif" align="middle"> В поле "Фамилия" введены недопустимые символы! </font>'; // Исправить проверку на регистрацию. Ввести недопустимые символы
    } 
    else{
        $login = $_POST['login'];
        $password = $_POST['password'];
        $mdPassword = md5($password);
        $name = $_POST['name'];
        $family = $_POST['lastname'];
        $date_reg = date("Y-m-d");
  			
        $query_login = ("SELECT id FROM users WHERE login='$login'");
        $sql = mysql_query($query_login) or die(mysql_error());
  			
        if (mysql_num_rows($sql) > 0) {
        	echo '<font color="red"><img border="0" src="error.gif" align="middle"> Пользователь с таким логином зарегистрирован!</font>';
        	}
        	else{
				$query = "INSERT INTO users (login, password, name, family, date_reg )
            	VALUES ('$login', '$mdPassword', '$name', '$family', '$date_reg')";
            	$result = mysql_query($query) or die(mysql_error());;
            	echo '<font color="green"><img border="0" src="ok.gif" align="middle"> Вы успешно зарегистрировались!</font><br><a href="index.php">На главную</a>';  								
            }
        }
    }   
?>