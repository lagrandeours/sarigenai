<?php
// セッションを開始
session_start();
// セッションIDを変更
session_regenerate_id(TRUE);

// 必要な関数を読み込む
require '../../../libs/functions.php';

// 画像認証ライブラリーを読み込む
$cryptinstall = './crypt/cryptographp.fct.php';
require $cryptinstall;

// テンプレートに渡す変数の初期化
$data = array();

$data['name']    = isset($_SESSION['name'])    ? $_SESSION['name']    : NULL;
$data['email']   = isset($_SESSION['email'])   ? $_SESSION['email']   : NULL;
$data['subject'] = isset($_SESSION['subject']) ? $_SESSION['subject'] : NULL;
$data['body']    = isset($_SESSION['body'])    ? $_SESSION['body']    : NULL;

// CSRF対策の固定トークンを生成
if (!isset($_SESSION['ticket'])) {
  // セッション変数にトークンを代入
  $_SESSION['ticket'] = sha1(uniqid(mt_rand(), TRUE));
}
// トークンをテンプレートに渡す
$data['ticket'] = $_SESSION['ticket'];

// テンプレートの表示
display('form1_view.php', $data);
