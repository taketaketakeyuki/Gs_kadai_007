<?php
$mode = $_POST["mode"];


function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}


//1.  DB接続します　  //insertのときと一緒。まず接続する。
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_yt_table WHERE unread is NULL");
$status = $stmt->execute();


//３．データ表示
$view="";

if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Select(SQLで書いた命令文)の仕様で、データの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    //.=は、一行下に追加に展開するコード
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $view .= '<div class="box"><table><tr><th>';
      $view .= h($result['title']);
      $view .= '</th></tr><tr><td><iframe width="560" height="315" src="https://www.youtube.com/embed/';
      $view .= h($result['URL']);
      $view .= '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td></tr><tr><td>';
      $view .= '<a href="unread.php?id=';
      $view .= $result['id'];
      $view .= '&unread=1';
      $view .= '">削除する</a></td></tr></table></div>';
  }
}

//4．CSVデータを作る
$stmt2 = $pdo->prepare("SELECT * FROM gs_yt_table WHERE unread is NULL");
$status2 = $stmt2->execute();
$all = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$allsjss = mb_convert_encoding($all, "SJIS", "utf8");
$fp = fopen('data/data.csv', 'w');
$columntitle = array('DB番号', '登録タイトル', 'youtubeURLID', '登録タイミング');
$columntitlesjss = mb_convert_encoding($columntitle, "SJIS", "utf8");
fputcsv($fp, $columntitlesjss);
foreach ($allsjss as $fields) {
  fputcsv($fp, $fields);
}
fclose($fp);


//5．CSVデータをダウンロードさせる

if ($mode == "output") {
  $filepath = 'data/data.csv';
  $dldate = date("Ymd");
  header("Content-Type: application/octet-stream");
  header('Content-Length: '.filesize($filepath));
  header("Content-Disposition: attachment; filename=CSVデータ一覧_{$dldate}.csv");

// 変数の初期化
$allsjss = array();
$csv = null;

// 1行目のラベルを作成
$csv = '"DB番号", 登録タイトル, youtubeURL, 登録タイミング' . "\n";
$csv = mb_convert_encoding($csv, "SJIS", "utf8");// SJSS変換
$stmt2 = $pdo->prepare("SELECT * FROM gs_yt_table WHERE unread is NULL");// DB取得
$status2 = $stmt2->execute();// まじない
$all = $stmt2->fetchAll(PDO::FETCH_ASSOC);// DBにふぇっち
$allsjss = mb_convert_encoding($all, "SJIS", "utf8");// SJSS変換
foreach ($allsjss as $value) {
  $csv .= '"' . $value['id'] . '","' . $value['title'] . '","' . 'https://www.youtube.com/watch?v=' . $value['URL'] . '","' . $value['date'] . '"' . "\n";
}
// CSVファイル出力
echo $csv;
return;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Youtube一覧シートPHP版</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/list.css">

    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">Youtube一覧シートPHP版</div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <input type="text" placeholder="ここにタイトル" size="20" name="title">
                <input type="text" size="20" placeholder="ここにURL" name="URLall">
                <input type="submit" value="送信">
            </fieldset>
            
        </div>
    </form>
    <!-- Main[End] -->

    <!--CSV出力ボタン-->
    <form action="./index.php" method="POST">
    <input type="hidden" name="mode" value="output"/>
    <input type="submit" value="一覧を出力する"/>
      </form>
    <!--CSV出力ボタン-->

    <!--一覧表示-->
    <div class="container jumbotron"><?=$view?></div>
    <!--一覧表示-->


<script src="js/jquery-2.1.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>

</html>



<!---->

