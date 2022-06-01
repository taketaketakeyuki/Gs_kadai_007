<?php

//1. POSTデータ取得
$id = $_GET['id'];
$unread = $_GET['unread'];


//2. DB接続します。おまじない。
try {
  //ID:'root', Password: 'root'
  //外から接続するときはそれぞれIDPASSが必要だが、MAMPの場合は初期IDとPASSが'root', 'root'。
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
  //new PDOというのはclassという概念。
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}


//３．データ更新

// 1. SQL文を用意…接続するpdoのところに、SQL文で入力。関数の挿入は＄で直接いけないので注意。。prepareの中は改行してOK
$stmt = $pdo->prepare("UPDATE gs_yt_table SET unread = :unread WHERE id = :id");

// :はバインド変数。$emailと書きたくなるところだが、（それでも動くが、）皆が入力するフォームなので一つ噛ませるイメージ。プログラムとかぶちこまれてもいいように…ということだと一旦理解。

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':unread', $unread, PDO::PARAM_STR);


//  3. 実行（おまじない）
$status = $stmt->execute();

//$statusの中には、trueかfalseが判定されて入る仕組み・

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{

  //５．index.phpへリダイレクト

   header('Location: index.php');
    //リダイレクト処理
}
?>
