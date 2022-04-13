<?php
// MySQLのvalidation設定
function validate($reviews) {
    $errors = [];
    // 書籍名のバリデーション
    if (!strlen($reviews['title'])) {
      $errors['title'] = '書籍名を入力してください';
    } elseif ($reviews['title'] > 100) {
      $errors['title'] = '書籍名は100文字以内で入力してください';
    }
  
    // 評価のバリデーション
    if (!is_int($reviews['score'])) {
      // $errors['score'] = '入力値は整数で入力してください'; 
    } elseif ($reviews['score'] < 1 || $reviews['score'] > 5 ) {
      $errors['score'] = '数値は1以上5以下の値を入力してください';
    }
  
    // 著者名のバリデーション
    if (!$reviews['author']) {
      $errors['author'] = '著者名を入力してください';
    } elseif ($reviews['author'] > 100) {
      $errors['author'] = '著者名は100文字以内で入力してください';
    }
  
    // 読書状況のバリデーション
    if (!in_array($reviews['status'], ['未読', '読んでる', '読了'], true)) {
      $errors['status'] = '読書状況には、「未読」、「読んでる」、「読了」のいずれかを入力してください';
    }
  
    // 感想に関するバリデーション
    if (!$reviews['summary']) {
      $errors['summary'] = '感想を入力してください';
    }
  
    return $errors;
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

function listReviews($link)
{
    echo '登録されている読書ログを表示します' . PHP_EOL;

    $sql = 'SELECT id, title, author, status, score, summary FROM reviews';
    $results = mysqli_query($link, $sql);

    while ($review = mysqli_fetch_assoc($results)) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['summary'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    mysqli_free_result($results);
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
        listReviews($link);
    } elseif($num === '9') {
        mysqli_close($link);
        break;
    }
}
