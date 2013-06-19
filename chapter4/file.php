<DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>file</title>
</head>
<body>
<?php
	$textfile = 'file.txt';

	// ファイルを開く
	$fp = fopen($textfile, 'r+b');
	if (!$fp) {		// fopen()関数の返り血の検証
		exit('ファイルがないか異常があります');
	}

	if (!flock($fp, LOCK_EX)) {		// テキストを排他的にロックとその返り血の検証
		exit('ファイルをロックできませんでした');
	}

	while (!feof($fp)) {		// ファイルの状態を確認して繰り返し処理
		echo fgets($fp) . '<br />';
	}

	// ファイルを閉じる
	fclose($fp);
?>
</body>
</html>
