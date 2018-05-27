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
        echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
      } else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<title>How to Integrate Google “No CAPTCHA reCAPTCHA” on Your Website</title>
  </head>

  <body>

    <form action="" method="post">

      <label for="name">Name:</label>
      <input name="name" required><br />

      <label for="email">Email:</label>
      <input name="email" type="email" required><br />

      <div class="g-recaptcha" data-sitekey="6LeKWj8UAAAAAFEWX_y0Ux4FN9oTcM9TWJ7vvGti"></div>

      <input type="submit" value="Submit" />

    </form>

    <!--js-->
    <script src='https://www.google.com/recaptcha/api.js'></script>

  </body>
</html>
<?php } ?>