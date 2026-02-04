<?php

require __DIR__ . '/../vendor/autoload.php';

$db = new SQLite3(__DIR__ . '/../db/hermes_development.sqlite');

$results = $db->query('SELECT * from feeds');
$feeds = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $feeds[] = $row;
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
            <?php require __DIR__ . '/new_feed.php'?>
        </div>

        <?php foreach($feeds as $feed): ?>
            <h1 class="linkfeed__title"><?= htmlspecialchars($feed['title']) ?></h1>

            <?php if ($feed['format'] === 'rss'): ?>
                <?php $rss = Feed::load($feed['url']) ?>
                <?php foreach($rss->item as $item): ?>
                    <div class="linkpost">
                        <p class="linkpost_date">
                            <?= htmlspecialchars($item->pubDate) ?>
                        </p>
                        <a href="<?= $item->link ?>" target="_blank">
                            <?= htmlspecialchars($item->title) ?>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endforeach ?>

        
        <?php foreach($rss->item as $item): ?>

            <div class="linkpost">
                <p class="linkpost__date">
                    <?= htmlspecialchars($item->pubDate) ?>
                </p>
                <a href="<?= $item->link ?>" target="_blank">
                    <?= htmlspecialchars($item->title) ?>
                </a>
            </div>

        <?php endforeach ?>
    </main>

</body>
</html>

