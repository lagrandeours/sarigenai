<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>テーブルタグ</title>
<!-- CSS -->
<LINK href="style.css" rel="stylesheet">
</head>
<body>
	<table>
		<caption>３×３のテーブル</caption>
		<tr>
			<td class="sho_img"><br></td>
			<td><br></td>
			<td><br></td>
		</tr>
		<tr>
			<td><br></td>
			<td><br></td>
			<td><br></td>
		</tr>
		<tr>
			<td><br></td>
			<td><br></td>
			<td><br></td>
		</tr>
	</table>
	<br />
	<table>
		<caption>セルを連結したテーブル</caption>
		<tr>
			<td rowspan=3 class="sho_img">画像</td>
			<td colspan=2>商品名</td>
		</tr>
		<tr>
			<td><br></td>
			<td>メーカー名</td>
		</tr>
		<tr>
			<td class="price">金額</td>
			<td><br></td>
		</tr>
	</table>
</body>
</html>
