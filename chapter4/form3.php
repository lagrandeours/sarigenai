<?php
// セッションを開始
session_start();

// 必要な関数を読み込む
require '../../libs/functions.php';

// POSTされたデータをチェック
$_POST = checkInput($_POST);

// 固定トークンを確認
if (isset($_POST['ticket'], $_SESSION['ticket'])) {
  $ticket = $_POST['ticket'];
  if ($ticket !== $_SESSION['ticket']) {
    die('不正アクセスの疑いがあります。');
  }
} else {
  die('不正アクセスの疑いがあります。');
}

// 変数にセッション変数を代入
$name    = $_SESSION['name'];
$email   = $_SESSION['email'];
$subject = $_SESSION['subject'];
$body    = $_SESSION['body'];

// メール宛て先
$mailTo  = 'newuser@example.jp';
// Return-Pathに指定するメールアドレス
$returnMail = 'newuser@example.jp';

// mbstringの日本語設定を行う
mb_language('ja');
mb_internal_encoding('UTF-8');

// Fromヘッダーを作成
$header = 'From: ' . mb_encode_mimeheader($name) . ' <' . $email . '>';

// メールの送信。セーフモードがOnの場合は第5引数が使えない
if (ini_get('safe_mode')) {
  $result = mb_send_mail($mailTo, $subject, $body, $header);
} else {
  $result = mb_send_mail($mailTo, $subject, $body, $header, '-f' . $returnMail);
}

// 送信結果をお知らせする変数を初期化
$message = '';

// メール送信の結果判定
if ($result) {
  $message =  '送信完了！';
  // セッション変数を破棄
  $_SESSION = array();
  session_destroy();
} else {
  $message = '送信失敗';
}

$data = array();
$data['message'] = $message;
display('form3_view.php', $data);
