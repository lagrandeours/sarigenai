<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>form1</title>
</head>
<body>
<pre>
<form action="form1.html">
<?php
	echo "こんにちは！". $_POST["name"]."さん\n";
	echo "あなたは". $_POST["age"]."歳です\n";
?>
</pre>
<input type="submit" value="戻る">
</form>
</body>
</html>