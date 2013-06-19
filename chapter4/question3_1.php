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
			require('dbconnect.php');

			$sql = 'select COUNT(*) as person from answer;';
			$result = mysql_query($sql);
			if(!$result) {
				die('①sql構文に誤りがある。' . mysql_error());
			}
			$row = mysql_fetch_assoc($result);
			$person = $row['person'];
			//テキストファイルの有効性のチェック
			if ($person != false) {
				// アンケート結果の集計と結果の表示
				echo '	<p>アンケートの集計結果：総数' . $person . '件</p>';
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
						$sql = 'select gender from answer;';
						$result = mysql_query($sql);
						if(!$result) {
							die('②sql構文に誤りがある。'.mysql_error());
						}

						$male = 0;
						$female=0;

						while($row = mysql_fetch_assoc($result)) {
							switch ($row['gender']) {
								case 1:
									$male += 1;
									break;
								case 2:
									$female += 1;
									break;
							}
						}
						$male_rate   = round($male / $person * 100);
						$female_rate = round($female / $person * 100);

						echo '	<td>男性：' . $male . '人 女性：' . $female . '人</td>';
						echo '	<td>男性：' . $male_rate . '% 女性：' . $female_rate . '%</td>';
						?>
					</tr>
					<tr>
						<td>年齢</td>
						<?php
						$sql = 'select age from answer;';
						$result = mysql_query($sql);
						if(!$result) {
							die('③sql構文に誤りがある' . mysql_error());
						}

						$age10=0;
						$age20=0;
						$age30=0;
						$age40=0;
						$age50=0;

						while($row = mysql_fetch_assoc($result)) {
							switch ($row['age']) {
								case 1:
									$age10 += 1;
									break;
								case 2:
									$age20 += 1;
									break;
								case 3:
									$age30 += 1;
									break;
								case 4:
									$age40 += 1;
									break;
								case 5:
									$age50 += 1;
									break;
							}
						}
						$age10_rate = round($age10 / $person * 100);
						$age20_rate = round($age20 / $person * 100);
						$age30_rate = round($age30 / $person * 100);
						$age40_rate = round($age40 / $person * 100);
						$age50_rate = round($age50 / $person * 100);

						echo '	<td>10代：' . $age10 . '人<br />' .
								'20代：' . $age20 . '人<br />' .
								'30代：' . $age30 . '人<br />' .
								'40代：' . $age40 . '人<br />' .
								'50代以上：' . $age50 . '人</td>' ;

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
						$sql = 'select hobby from answerhobby;';
						$result = mysql_query($sql);
						if (!$result) {
							die('④sql構文に誤りがある。'.mysql_error());
						}

						$hobby1=0;
						$hobby2=0;
						$hobby3=0;
						$hobby4=0;
						$hobby5=0;

						while ($row = mysql_fetch_assoc($result)) {
							switch ($row['hobby']) {
								case 1:
									$hobby1 += 1;
									break;
								case 2:
									$hobby2 += 1;
									break;
								case 3 :
									$hobby3 += 1;
									break;
								case 4:
									$hobby4 += 1;
									break;
								case 5:
									$hobby5 += 1;
									break;
							}
						}

						$hobby1_rate = round($hobby1 / $person * 100);
						$hobby2_rate = round($hobby2 / $person * 100);
						$hobby3_rate = round($hobby3 / $person * 100);
						$hobby4_rate = round($hobby4 / $person * 100);
						$hobby5_rate = round($hobby5 / $person * 100);

						$sql = 'select count(hobby) as hobby from answerhobby group by id';
						$result = mysql_query($sql) or die(mysql_error());
						$i = 0;
						$sum = 0;
						$list = array();
						while($row = mysql_fetch_assoc($result)){
							$unko = $row['hobby'];
							array_push($list,$unko);
							$sum += $unko;
							$i++;
						}
						$max = max($list);
						$min = min($list);
						$avg= round($sum / $i);

						echo '	<td>音楽鑑賞：' . $hobby1 . '人<br />' .
								'映画鑑賞：' . $hobby2 . '人<br />' .
								'ドライブ：' . $hobby3 . '人<br />' .
								'旅行：' . $hobby4 . '人<br />' .
								'その他：' . $hobby5 . '人<br />'.
								'最大選択数：'.$max.'<br />' .
								'最小選択数：'.$min.'<br />'.
								'平均選択数：'.$avg.'</td>';

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
