<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>counter</title>
</head>
<body>
<pre>
<?php
	$fp = fopen("count.txt","r++"); //読み書きモードでオープン
	$n = fgets($fp); //文字列の読み取り
	$n++;	//カウントアップ
	echo $n,"人目";	//表示
	rewind($fp);	//読み書き位置を先頭に戻す
	fputs($fp,$n); //書き込み
	fclose($fp);	//ファイルを閉じる
?>
</body>
</html>