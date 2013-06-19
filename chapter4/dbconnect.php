<?php
	$link = mysql_connect('localhost','unko','unko');
	if(!$link) {
		die('データベースにログインできませんでした。'. mysql_error());
	}

	$dbselect = mysql_select_db('question2', $link);
	if(!$dbselect) {
		die('データベースを選択できませんでした');
	}

	mysql_set_charset('utf-8');
?>