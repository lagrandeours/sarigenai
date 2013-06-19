<?php
	$link = mysql_connect('localhost','root') or die('データベースにログインできませんでした。'. mysql_error());;

	$dbselect = mysql_select_db('goods', $link) or die('データベースを選択できませんでした');

	mysql_set_charset('utf-8');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>商品一覧</title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div id="conteiner">
<h1>商品一覧</h1>
<form action="kadai.php" name="navi" method="post">
	<select name="sort">
	<option value = "0">----区分選択----</option>
	<?php
		$count = 0;
		$sql = 'select c_id,c_name from class  order by c_id';
		$result = mysql_query($sql) or mysql_error();
		while($row = mysql_fetch_assoc($result)){
			$count++;
			echo '<option value="'  . $count . '">' . $row['c_name'] .'</option>';
		}
		?>
	</select>
	<input type="radio" name="orderby" value="1">昇順
	<input type="radio" name="orderby" value="2">降順
	<input type="submit" value="並び替え">
</form>
<br />

<?php
	$sql = 'select g.c_id, g_id, c_name, g_name, m_name, price, image from goods g,class c,maker m
		where g.c_id = c.c_id AND g.m_id = m.m_id ';
	$kubun = '';
	$order = 'order by c_id';
	if(isset($_POST['sort'])) {
		//区分判定
		for($i = 1;$i <= $count; $i++) {
			if($_POST['sort'] == $i) {
				$kubun = 'AND g.c_id = ' . $i . ' ';
			}
		}
		}else{
			$kubun='';
		}

	if (isset($_POST['orderby'])) {
		if($_POST['orderby'] == "1") {
			$order = 'order by price asc';

		}else if($_POST['orderby'] == "2"){
			$order = 'order by price desc';
		}
	}
	$result = mysql_query($sql.$kubun.$order);
	if (!$result) {
		die('sql構文に誤りがあります');
	}
	echo '<table border="3">';
	echo '<thead>';
	$subject = array("区分","商品名","メーカー","価格","イメージ");
	echo '<tr>';
	foreach($subject as $unko) {
		echo '<th>'.$unko.'</th>';
	}
	echo '</tr>';
	echo '</thead>';

	echo '<tbody>';
	while($row = mysql_fetch_assoc($result)) {
	$price = number_format($row['price']);
		echo '<tr><td class="kubun">'  . $row['c_name'] . '</td><td>' . $row['g_name'] . '</td><td>' . $row['m_name'] . '</td><td>\\' . $price .
				 '</td><td><img src="img/' . $row['image'] .'" width="250" height="200"></td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
?>
</div>
</body>
</html>