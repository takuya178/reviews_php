<?php

// データベースに接続
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

// 例外処理
if (!$link) {
  echo 'ERROR: データベースに接続できませんでした' . PHP_EOL;
  echo 'Debugging error' . mysqli_connect_error() . PHP_EOL;
  exit;
}

echo 'データベースに接続できました' . PHP_EOL; 
mysqli_close($link);
echo 'データベースを切断しました' . PHP_EOL;