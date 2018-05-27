<?php
session_start();
include ("./html/mycaptcha.php");
if ($_REQUEST['send']!='')
{

  if(!isset($_SESSION['captcha_keystring']) ||
     $_SESSION['captcha_keystring'] != $_REQUEST['keystring'])
  {
    $message="<p>Форма не отправлена!</p>";
  }
  else
  {
    // получение
    $message = htmlspecialchars($_REQUEST["Name"].", ".$_REQUEST["Email Address"]." на тему ".$_REQUEST["Subject"].": ".$_REQUEST['message'], ENT_QUOTES)

    // тест
    $message = iconv("utf-8", "koi8-r", $message);

  }
}

if ($message!="")
{
  echo $message;
}
else
{
?>

<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>contact - Space Science Website Template</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script src="js/mobile.js" type="text/javascript"></script>
</head>
<body>
	<div id="page">
		<div id="header">
			<div>
				<a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
				<ul id="navigation">
					<li class="selected">
						<a href="index.html">Главная</a>
					</li>

					<li class="menu">
						<a href="projects.html">Перевод</a>

					</li>
					<li class="menu">
						<a href="blog.html">Media</a>

					</li>
					<li>
						<a href="contact.html">Связаться</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="body">
			<div class="header">
				<div class="contact">
					<h1>Связаться</h1>
					<h2>Заполните форму ниже</h2>
					<form method="post">
					    <input type="hidden" name="send" value="1"/>
						<input type="text" name="Name" value="Псевдоним" onblur="this.value=!this.value?'Псевдоним':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<input type="text" name="Email Address" value="Адрес электронной почты" onblur="this.value=!this.value?'Адрес электронной почты':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<input type="text" name="Subject" value="Тема" onblur="this.value=!this.value?'Тема':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<textarea name="message" cols="50" rows="7" required></textarea>
						<img src="./html/kindex.php?<?php echo session_name()?>=<?php echo session_id()?>" width="120" height="60"><br/>
                        Введите код с картинки:<br/>
                        <input name="keystring" required><br/>
						<input type="submit" value="Отправить" id="submit">
					</form>
				</div>
			</div>
		</div>
		<div id="footer">
			<div class="connect">
				<div>
					<h1>Следите за нами в </h1>
					<section>
						<a href="https://twitch.tv/jediknightchannel/"><img src="./images/social/twitch.jpg" height="40px" width="40px"></a>
						<a href="https://vk.com/jediknightchannel"><img src="./images/social/vk.png" height="40px" width="40px"></a>
						<a href="https://www.youtube.com/channel/UCq3OueoADMdxxYs_Oauodog"><img src="./images/social/youtube.png" height="40px" width="40px"></a>
					</section>
				</div>
			</div>
			<div class="footnote">
				<div>
					<p>&copy; 2017 BY JEDIKNIGHTCHANNEL | ALL RIGHTS RESERVED</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?
}
?>
