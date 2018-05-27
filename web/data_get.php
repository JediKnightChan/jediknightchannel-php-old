<?php
function is_allowed($filename) { //checks whether the file requested by user is correctable
	$check_filename = "filenames.txt";
	$checking_file = fopen($check_filename, "r");
	$cont = fread($checking_file, filesize($check_filename));
	$filenames = explode("\n", $cont);
	return in_array($filename, $filenames);
}
$filename = $_POST["filename"];
if (is_allowed($filename)) {
	echo "Allowed";
	$content = $_POST["num"]." --- ".$_POST["text"]." \r\n";
	$file_cor = fopen("/home/files/correction/cor-files/$filename", "a");
	fwrite($file_cor, $content);
} else {
	echo "File not found";
}
?>
