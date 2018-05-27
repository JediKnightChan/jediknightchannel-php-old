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
      if ($response == null || !$response->success) {
?>
<!DOCTYPE HTML>
<html>
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <form method="post">
    <div class="g-recaptcha" data-sitekey="6LeKWj8UAAAAAFEWX_y0Ux4FN9oTcM9TWJ7vvGti"></div>
    <input type="submit" value="Отправить" id="submit">
    </form>
</body>
</html>
<?php } else {
?>



<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JediKnightChan - Перевод</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css">
    <link rel="stylesheet" href="button.css">
    <script src="js/mobile.js" type="text/javascript"></script>
    <style>
        .noselect {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
        .invisible {
            display: none;
        }

        .translation {
            border-spacing: 50px;
            padding-top: 100px;
            font-family: EuroStyle;
            color: white;
        }

        .translation tr th {
            font-size: 20px;
            font-family: "Franklin Gothic Demi";
            color: white;
            padding-bottom: 50px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .translation tr td textarea {
            background-color: black;
            font-family: EuroStyle;
            color: white;
            border: solid 1px #D4AF37;
        }

        .translation tr td {
            padding: 20px 20px;
            width: 30%;
        }

	td {
	    font-size: 20px;
	}

    </style>
</head>
<body>
<div id="page">
    <div id="header">
        <div>
            <a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
            <ul id="navigation">
                <li>
                    <a href="index.html">Главная</a>
                </li>

                <li class="selected">
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
    <div id="body" class="noselect">
        <div class="translation">
            <div>
                <table>
                    <?php
                        function is_allowed($filename) { //checks whether the file requested by user is correctable
                                $check_filename = "filenames.txt";
                                $checking_file = fopen($check_filename, "r");
                                $cont = fread($checking_file, filesize($check_filename));
                                $filenames = explode("\n", $cont);
                                return in_array($filename, $filenames);
                        }

					    $file = str_replace("query=", "", $_SERVER['QUERY_STRING']);
					    if (is_allowed($file)) {
						$file = "/home/files/correction/src-files/$file";
					        $cont = "<tr><th>Оригинал</th><th>Перевод</th><th>Правка</th></tr>$br";
					        $pairs = file($file);
					        $counter = 1;
					        foreach ($pairs as $line) {
					            $pair = explode(" = ", $line);
					            $en = $pair[0];
                                $ru = $pair[1];
                                $cont .= '<tr><td>'.$en.'</td><td>'.$ru.'</td><td><div class="input-group"><p class="invisible">'.$counter.'</p><textarea class="form-control custom-control" rows="3" cols="90" style="resize:none;font-size:20px;"></textarea><span class="input-group-addon btn btn-primary" onclick="send_data(this)">Send</span></div></td>';
                                $counter++;
                                }

                            echo $cont;
					    } else {
					        echo "File not found";
					    }
                    ?>
                </table>
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
<script>
    function get_query(str_) { //returns a string with the value of a query from webpage utl
        var nstr_ = str_.replace("query=", "Ё");
        var in_filename = false;
        var res = "";
        for (let i = 0; i < nstr_.length; i++) {
            if (in_filename) {
                res += nstr_[i];
            }
            if (nstr_[i] == "Ё") {
                in_filename = true;
            }

        }
        return res;
        }

    var filename = get_query(location.toString());
    function send_data(button) {
        s = button.previousElementSibling;
        var text = s.value;
        var num = s.previousSibling.textContent;
        var data = new FormData();
        data.append("num", num);
        data.append("text", text);
        data.append("filename", filename);
        var http = new XMLHttpRequest();
        var url = "data_get.php";
        http.open("POST", url, true);

        http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    if(http.responseText == "Allowed") {
                        if(button.style.backgroundColor == "#D4AF37") {
                            button.style.backgroundColor = "#FFD700"
                        } else {
                            button.style.backgroundColor = "#D4AF37";
                        }

                    }
                    if(http.responseText == "File not found") {
                        alert("Файл не найден");
		            }
                }
            }
        http.send(data);

    }
</script>
</body>
</html>

<?php } ?>