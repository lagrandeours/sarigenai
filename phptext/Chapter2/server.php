<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Lesson</title>
</head>
<body>
<pre>
<?php
	$browser=$_SERVER["HTTP_USER_AGENT"];
	echo $browser;
	if (strpos($browser,"MSIE")!==false) {
		echo "\n ブラウザは InternetExplorer です \n";
	}
?>
</pre>
</body>
</html>