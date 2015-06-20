<html>
  <head>
    <link rel="shortcut icon" href="http://www.sdws.ru/favicon.ico" type="image/x-icon">
    <link href="css/registration.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Регистрация</title>
  </head>
  <body>
    <div id="main">
      <img src="image/white.jpg" id="white" class="transparency">
      <img src="image/name.png" id="name" class="no_transparency" >
      <div id='user'>
          <form method='post' action='testreg.php'>
            <table>
              <tr>
                <td colspan='2'><input type='text' id='login' placeholder='Логин' name='login'></td>
              </tr>
                <tr>
                <td colspan='2'><input type='password' id='password' placeholder='Пароль' name='password'></td>
              </tr>
              <tr>
                <td align="left"><input type='submit' name='submit' class='button' value='Вход'></td>
                <td align="right"><a href='index.php'><input type='button' class='button' value='Главная'></a></td>
              </tr>              
            </table>
          </form>
        </div>
      <img src="image/lenta_registration.png" id="lenta" /> 
      <div id="registration" >
      <br>
      <center><table>
        <form action="php/save/save_user.php" method="post" enctype="multipart/form-data">
        <tr>
          <td class="inscriptions">Логин:</td>
          <td><input class="field" type="text" size="30" maxlength="16" name="login" ></td>
        </tr>
        <tr>
          <td class="inscriptions">Пароль:</td>
          <td><input class="field" type="password" size="30" maxlength="16" name="password" ></td>
        </tr>
        <tr>
          <td class="inscriptions">Подтверждения пароля:</td>
          <td><input class="field" type="password" size="30" maxlength="16" name="password_repeat"></td>
        </tr>
        <tr>
          <td class="inscriptions">Имя:</td>
          <td><input class="field" type="text" size="30" maxlength="20" name="name"></td>
        </tr>
        <tr>
          <td class="inscriptions">Фамилия:</td>
          <td><input class="field" type="text" size="30" maxlength="30" name="lastname"></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="3" align="right"><input class="button" type="submit" value="Зарегистроваться" name="submit" ></td>
        </tr>
        <br>
        </form>
      </table></center>
      </div>
      <div id="copyright">
      <strong>Copyright © 2015. Михайлов Олег. Все права защищены.</strong>
      <p>Перепечатка материалов и использование их в любой форме, в том 
      числе и в электронных СМИ, возможны только с письменного разрешения 
      администрации сайта. При этом ссылка на сайт обязательна.</p>
    </div>  
    </div> 
  </body>
</html>
