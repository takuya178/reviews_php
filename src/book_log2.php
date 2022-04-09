<?php
// 読書ログを登録してください
// 書籍名：
// 著者名：
// 読書状況（未読,読んでる,読了）：
// 評価（5点満点の整数）：
// 感想：
// 登録が完了しました

// 読書ログを表示します
// 書籍名：{登録した書籍名}
// 著者名：{登録した著者名}
// 読書状況：{登録した読書状況}
// 評価：{登録した評価}
// 感想：{登録した感想}

echo '読書ログを登録してください'. PHP_EOL;
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

echo '読書ログを表示します'. PHP_EOL;
echo '書籍名：' . $title . PHP_EOL;
echo '著者名：' . $author . PHP_EOL;
echo '読書状況（未読,読んでる,読了）：' . $status . PHP_EOL;
echo '評価（5点満点の整数）：' . $score . PHP_EOL;
echo '感想：' . $summary . PHP_EOL;
