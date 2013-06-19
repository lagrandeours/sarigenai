<?php
$textfile = 'write.txt';
$fruits = array('リンゴ','みかん','ばなーな');

$fp = fopen($textfile, 'r+b');
if(!$fp) {
	die ('ファイルがないか異常があります');
}

if (!flock($fp, LOCK_EX)) {
	die ('ファイルをロックできませんでした');
}

foreach ($fruits as $value) {
	fwrite ($fp, $value . "\n");
}

rewind($fp);

while (!feof($fp)) {
	echo fgets($fp) . '<br />';
}

fclose($fp);