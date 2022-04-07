<?php

// MySQLのvalidation設定
function validate($reviews) 
{
    $errors = [];
    // 書籍名の入力チェック
    if (!strlen($reviews['title'])) {
      $errors['title'] = '書籍名を入力してください' . PHP_EOL;
    } elseif ($reviews['title'] > 100) {
      $errors['title'] = '書籍名は100文字以内で入力してください' . PHP_EOL;
    }
    return $errors;
}

// MySQLとの接続
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error: データベースに接続できません' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースと接続しました' . PHP_EOL;
    return $link;
}

function createReview($link)
{
    $reviews = [];

    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $reviews['title'] = trim(fgets(STDIN));
    
    echo '著者名：';
    $reviews['author'] = trim(fgets(STDIN));
    
    echo '読書状況（未読,読んでる,読了）：';
    $reviews['status'] = trim(fgets(STDIN));
    
    echo '評価（5点満点の整数）：';
    $reviews['score'] = trim(fgets(STDIN));
    
    echo '感想：';
    $reviews['summary'] = trim(fgets(STDIN));

    // MySQLにvalidationを追加
    $validated = validate($reviews);
    if(count($validated) > 0) {
        foreach($validated as $error) {
          echo $error . PHP_EOL;
        }
        return;
    }

    // MySQLにデータを登録
    $sql = <<<EOT
    INSERT INTO reviews (
        title,
        author,
        status,
        score,
        summary
    ) VALUES (
        "{$reviews['title']}",
        "{$reviews['author']}",
        "{$reviews['status']}",
        "{$reviews['score']}",
        "{$reviews['summary']}"
    )
    EOT;
    
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'データを追加しました'. PHP_EOL;
    } else {
        echo 'Error: データの追加に失敗しました'. PHP_EOL;
        echo 'Debugging error;' . mysqli_error($link). PHP_EOL;
    }
}

function listReviews($reviews)
{
    echo '登録されている読書ログを表示します' . PHP_EOL;
    foreach ($reviews as $review) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['summary'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}

$reviews = [];
$link = dbConnect();

while (true) {
    echo '1. 読書ログを登録'. PHP_EOL;
    echo '2. 読書ログを表示'. PHP_EOL;
    echo '9. アプリケーションを終了'. PHP_EOL;
    echo '番号を選択してください (1,2,9)'. PHP_EOL;
    $num = trim(fgets(STDIN));
    
    if ($num === '1') {
        // 読書ログを登録
        $reviews[] = createReview($link);
    } elseif ($num === '2') {
        // 読書ログを表示
        listReviews($reviews);
    } elseif($num === '9') {
        mysqli_close($link);
        break;
    }
}
