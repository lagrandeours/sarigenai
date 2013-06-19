<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<title>アンケートフォーム</title>
<link rel="stylesheet" type="text/css" href="css/style.css"
	media="screen,tv" />
</head>
<body>
	<div id="box">
		<div id="header">
			<h1>PHP for Web Designer</h1>
		</div>
		<ul id="menu" class="clearfix">
			<li class="active"><a href="question1.php">アンケート</a></li>
			<li><a href="form1.php">メールフォーム</a></li>
			<li><a href="webapi/">グルメMAP</a></li>
		</ul>
		<div id="main">
			<h2>アンケートフォーム</h2>
			<?php
			$error = true;

			// 性別の入力チェック
			if (isset($_POST['gender'])) {
				$gender = $_POST['gender'];

				if (ctype_digit($gender)) {
					if ($gender == 1){
						$gendername = '男性';
					} elseif($gender == 2) {
						$gendername = '女性';
					} else {
						$error = false;
					}
				} else { // ctype_digit()関数で変数が数字ではなかった場合
					$error = false;
				}
			} else { // isset()で変数が未定義だった場合
				$error = false;
			}

			//年齢の入力チェック
			if (isset($_POST['age'])) {
				$age = $_POST['age'];

				if (ctype_digit($age)){	//入力が数字のみか？
					//	1より小さい、または、5より大きいか？
					if($age < 1 || $age > 5) {
						$error = false;	//入力エラー
					}
				} else {	// ctype_digit()関数で変数が数字ではなかった場合
					$error = false;
				}
			} else {	// isset()で変数が未定義だった場合
				$error = false;	//入力エラー
			}

			//趣味の入力チェック
			if (isset($_POST['hobby'])) {
				$hobby = $_POST['hobby'];

				if (is_array($hobby)) {	// 配列か？
					foreach ($hobby as $value) {
						if (ctype_digit($value)) {
							// 1より小さい、または、5より大きいか?
							if ($value < 1 || $value > 5) {
								$error = false; // 入力エラー
							}
						} else {	// ctype_digit()関数で変数が数字ではなかった場合
							$error = false;
						}
					}
				} else {	// is_array()関数で変数が入れるではなかった場合
					$error = false;	// 入力エラー
				}
			} else { // isset()で変数が未定義だった場合
				$error = false; // 入力エラー
			}

			//入力エラーがない場合の結果表示
			if ($error) {
				// 性別の表示
				echo '<dl class = "clearfix">';
				echo '<dt>性別は？</dt><dd>' . $gendername . '</dd>';

				// 年齢の表示
				if ($age != 5) {
					echo '<dt>年齢は？</dt><dd>' . $age . '0代</dd>';
				} else {
			echo '<dt>年齢は？</dt><dd>50代以上</dd>';
		}
		// 趣味の表示
		echo '<dt>趣味は？</dt>';
		echo '<dd>';
		// foreach構文で配列の中身だけ繰り返し処理
		// 趣味の値から条件分布させて一致した文字列を表示
		foreach ($hobby as $value) {
			switch($value) {
				case 1:
					echo '音楽鑑賞<br />';
					break;
				case 2:
					echo '映画鑑賞<br />';
					break;
				case 3:
					echo 'ドライブ<br />';
					break;
				case 4:
					echo '旅行<br />';
					break;
				case 5:
					echo 'その他<br />';
					break;
			}
		}
		echo '</dd>';
		// log.txtの読み込み処理
		// アンケート結果を保存するテキストファイルを指定
		$textfile = '../../../log/log.txt';

		// アンケート結果の読み込み処理
		// ファイルを開く
		$fp = fopen($textfile, 'r+b');
		if (!$fp) {	//	fopen()関数の返り値の検証
			exit ('ファイルがないか異常があります');
		}
		if (!flock($fp, LOCK_EX)) {	//	テキストを排他的にロックとその返り値の検証
			exit ('ファイルをロックできませんでした');
		}
		while (!feof($fp)) {
			$writebuffer[] = trim(fgets($fp));	//	ファイルの状態を確認して繰り返し処理
		}

		//古いアンケート結果に新しいアンケート結果を加算
		//性別データの計算
		if ($gender == 1) $writebuffer[0]++;
		if ($gender == 2) $writebuffer[1]++;

		//年齢データの計算
		$writebuffer[$age + 1]++;

		//趣味データの計算
		foreach ($hobby as $key => $value) {
			$writebuffer[$key + 6]++;
		}

		//アンケートに答えた総人数の加算
		$writebuffer[12]++;

		//加算したアンケート結果をテキストファイルに保存
		//ファイルポインタを先頭に戻す
		rewind ($fp);
		foreach ($writebuffer as $value) {
			fwrite($fp, $value . "\n");
		}
		//ファイルを閉じる(ロック解除)
		fclose($fp);

		echo '</dl>';
		echo '<p class="app_msg">以上の内容を保存しました！</p>';
		echo '<p class="app_msg"><a href="question3.php">集計結果を見る</a></p>';
		//　アンケートの結果表示と結果の保存処理
			} else {
		//入力エラーがある場合のエラー表示
		echo '<p class="app_msg">';
		echo '戻ってアンケートの項目すべてにお答えください。';
		echo '</p>';
	}
	?>
		</div>
		<p class="copy">&copy; 2010 PHP for Web Designer. All rights reserved.
		</p>
	</div>
</body>
</html>
