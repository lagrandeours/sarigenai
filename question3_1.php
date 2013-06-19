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
			<li class="active"><a href="question1_3.php">アンケート</a></li>
			<li><a href="form1.php">メールフォーム</a></li>
			<li><a href="webapi/">グルメMAP</a></li>
		</ul>
		<div id="main">
			<h2>アンケートフォーム</h2>
			<?php
			//アンケート結果が保存されたテキストファイルを指定
			$textfile = '../../../log/log.txt';
			$fp = fopen($textfile, 'rb');	//	rで読み込みモード、bで互換性維持
			if (!$fp) {
					die ('ファイルがないか異常があります');
				}
				if (!flock($fp, LOCK_EX)) {
					die ('ファイルをロックできませんでした');
				}
				while (!feof($fp)) {
					$buffer[] = trim(fgets($fp));
				}

				//テキストファイルの有効性のチェック
				if ($buffer[12] != 0) {
					// アンケート結果の集計と結果の表示
					echo '	<p>アンケートの集計結果：総数' . $buffer[12] . '件</p>';
					?>
			<table class="question">
				<thead>
					<tr>
						<th>質問</th>
						<th>人数</th>
						<th>比率</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>性別</td>
						<?php
						//男女の比率計算
						$male_rate   = round($buffer[0] / $buffer[12] * 100);
						$female_rate = round($buffer[1] / $buffer[12] * 100);

						echo '	<td>男性：' . $buffer[0] . '人 女性：' . $buffer[1] . '人</td>';
						echo '	<td>男性：' . $male_rate . '% 女性：' . $female_rate . '%</td>';
						?>
					</tr>
					<tr>
						<td>年齢</td>
						<?php
						$age10_rate = round($buffer[2] / $buffer[12] * 100);
						$age20_rate = round($buffer[3] / $buffer[12] * 100);
						$age30_rate = round($buffer[4] / $buffer[12] * 100);
						$age40_rate = round($buffer[5] / $buffer[12] * 100);
						$age50_rate = round($buffer[6] / $buffer[12] * 100);

						echo '	<td>10代：' . $buffer[2] . '人<br />' .
								'20代：' . $buffer[3] . '人<br />' .
								'30代：' . $buffer[4] . '人<br />' .
								'40代：' . $buffer[5] . '人<br />' .
								'50代以上：' . $buffer[6] . '人</td>' ;

						echo '<td>10代：' . $age10_rate . '%<br />' .
								'20代：' . $age20_rate . '%<br />' .
								'30代：' . $age30_rate . '%<br />' .
								'40代：' . $age40_rate . '%<br />' .
								'50代以上：' . $age50_rate . '%</td>' ;
						?>
					</tr>
					<tr>
						<td>趣味</td>
						<?php
						$hobby1_rate = round($buffer[7] / $buffer[12] * 100);
						$hobby2_rate = round($buffer[8] / $buffer[12] * 100);
						$hobby3_rate = round($buffer[9] / $buffer[12] * 100);
						$hobby4_rate = round($buffer[10] / $buffer[12] * 100);
						$hobby5_rate = round($buffer[11] / $buffer[12] * 100);

						echo '	<td>音楽鑑賞：' . $buffer[7] . '人<br />' .
								'映画鑑賞：' . $buffer[8] . '人<br />' .
								'ドライブ：' . $buffer[9] . '人<br />' .
								'旅行：' . $buffer[10] . '人<br />' .
								'その他：' . $buffer[11] . '人</td>' ;

						echo '<td>音楽鑑賞：' . $hobby1_rate . '%<br />' .
								'映画鑑賞：' . $hobby2_rate . '%<br />' .
								'ドライブ：' . $hobby3_rate . '%<br />' .
								'旅行：' . $hobby4_rate . '%<br />' .
								'その他：' . $hobby5_rate . '%</td>' ;
								?>
					</tr>
				</tbody>
			</table>
			<?php
			} else {
				// アンケートデータがない場合
				echo '	<p class="app_msg">';
				echo '表示できるようなアンケートデータがありません。';
				echo '</p>';
			}
			?>
		</div>
		<p class="copy">&copy; 2010 PHP for Web Designer. All rights reserved.
		</p>
	</div>
</body>
</html>
