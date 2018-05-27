<?php

require_once "recaptchalib.php";

$secret = "6LeKWj8UAAAAAEsuSnZHwnViXgDrb_wZTU-eXdo3";

// пустой ответ
$response = null;

// проверка секретного ключа
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
?>
<?php
    if ($response != null && $response->success) {
        $message = "От ".$_POST["Name"].", ".$_POST["Address"]." на тему ".$_POST["Subject"].":\r\n ".$_POST["message"]."\r\n\r\n";
        $message = htmlspecialchars($message, ENT_QUOTES);
        $file = fopen("/home/files/feedback.txt", "a");
        fwrite($file, $message);
        fclose($file);
	echo '<!doctype html><html><head><meta http-equiv="refresh" content="0; url=index.html"></head><body></body></html>';
    } else {
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
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style>
        .g-recaptcha div {
            height: 120px !important;
        }
	</style>
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
						<input type="text" name="Name" value="Псевдоним" onblur="this.value=!this.value?'Псевдоним':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<input type="text" name="Address" value="Адрес электронной почты" onblur="this.value=!this.value?'Адрес электронной почты':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<input type="text" name="Subject" value="Тема" onblur="this.value=!this.value?'Тема':this.value;" onfocus="this.select()" onclick="this.value='';" required>
						<textarea name="message" cols="50" rows="7" required></textarea>
						<div class="g-recaptcha" data-sitekey="6LeKWj8UAAAAAFEWX_y0Ux4FN9oTcM9TWJ7vvGti"></div><br>
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
<?php } ?>
