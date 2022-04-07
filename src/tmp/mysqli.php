<?php

// データベースに接続
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

// 例外処理
if (!$link) {
  echo 'ERROR: データベースに接続できませんでした' . PHP_EOL;
  echo 'Debugging error' . mysqli_connect_error() . PHP_EOL;
  exit;
}

$sql = <<<EOT
INSERT INTO companies (
    name,
    establishment_data,
    founder
) VALUES (
    'Smart HR',
    2008,
    'miyata seizi'
)
EOT;

$result = mysqli_query($link, $sql);
if ($result) {
    echo 'データを追加しました'. PHP_EOL;
} else {
    echo 'Error: データの追加に失敗しました'. PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link). PHP_EOL;
}

echo 'データベースに接続できました' . PHP_EOL; 
mysqli_close($link);
echo 'データベースを切断しました' . PHP_EOL;