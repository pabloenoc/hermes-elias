<?php

require __DIR__ . '/../vendor/autoload.php';

$db = new SQLite3(__DIR__ . '/../db/hermes_development.sqlite');

$results = $db->query('SELECT * from feeds');
$feeds = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $feeds[] = $row;
}

foreach($feeds as $feed) {
    try {
        $xml = Feed::load($feed['url']);
    }
    catch(FeedException $e) {
        echo "<pre>";
        echo $feed['url'];
        echo "\n";
        echo $e->getMessage();
        die;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hermes - Elias</title>
</head>
<body>
    <navbar>
        <a href='/'>
            <img src='images/logo.webp'>
            <h1>Home</h1>
        </a>
    </navbar>
    <main>
        <div>
            <?php require __DIR__ . '/new_feed.php' ?>
        </div>

        <div class="two-columns" style="break-inside: avoid";>
            <p>TODO: Show feeds in posts</p>
        </div>

    </main>

</body>
</html>

