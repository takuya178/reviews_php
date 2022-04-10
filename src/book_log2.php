<?php
function createReview()
{
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

    return [
        'title' => $title,
        'author' => $author,
        'status' => $status,
        'score' => $score,
        'summary' => $summary
    ];
}

// ブックログの一覧表示
function reviewList($lists)
{
    echo '読書ログを表示します'. PHP_EOL;

    foreach ($lists as $list) {
          echo '書籍名：' . $list['title'] . PHP_EOL;
          echo '著者名：' . $list['author'] . PHP_EOL;
          echo '読書状況（未読,読んでる,読了）：' . $list['status'] . PHP_EOL;
          echo '評価（5点満点の整数）：' . $list['score'] . PHP_EOL;
          echo '感想：' . $list['summary'] . PHP_EOL;
          echo "-------------" . PHP_EOL;
    }
}

while(true) {
    echo '読書ログを登録してください'. PHP_EOL;
    echo '1.読書ログを登録する'. PHP_EOL;
    echo '2.読書ログを表示する'. PHP_EOL;
    echo '9.読書ログを終了する'. PHP_EOL;
    $num = trim(fgets(STDIN));
    
    if ($num === '1') {
        $lists[] = createReview();
        var_dump(createReview());
    } elseif ($num === '2') {
        reviewList($lists);
    } elseif ($num === '9') {
        break;
    }
}

