<?php
// 読書ログサービスに、番号2を選択された際に読書ログを表示する処理を記載しましょう。
// 番号2を選択すると、下記が表示されれば成功です。

// 登録されている読書ログを表示します
// 書籍名：
// 著者名：
// 読書状況：
// 評価：
// 感想：

$title = '';
$author = '';
$status = '';
$score = '';
$summary = '';

echo '読書ログを登録してください'. PHP_EOL;
echo '1.読書ログを登録する'. PHP_EOL;
echo '2.読書ログを表示する'. PHP_EOL;
echo '9.読書ログを終了する'. PHP_EOL;
$num = trim(fgets(STDIN));

if ($num === '1') {
    echo '書籍名：';
    $title = trim(fgets(STDIN));
    echo '著者名：';
    $author = trim(fgets(STDIN));
    echo '読書状況（未読,読んでる,読了）：';
    $status = trim(fgets(STDIN));
    echo '評価（5点満点の整数）：';
    $score = trim(fgets(STDIN));
    echo '感想：';
    $summary = trim(fgets(STDIN));
    echo '登録が完了しました';
} elseif ($num === '2') {
    echo '読書ログを表示します'. PHP_EOL;
    echo '書籍名：' . $title . PHP_EOL;
    echo '著者名：' . $author . PHP_EOL;
    echo '読書状況（未読,読んでる,読了）：' . $status . PHP_EOL;
    echo '評価（5点満点の整数）：' . $score . PHP_EOL;
    echo '感想：' . $summary . PHP_EOL;
}

