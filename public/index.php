<?php

require __DIR__ . '/../vendor/autoload.php';

$db = new SQLite3(__DIR__ . '/../db/hermes_development.sqlite');

$results = $db->query('SELECT * from feeds');
$feeds = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $feeds[] = $row;
}

$errors = [];

foreach($feeds as $index => $feed) {
	try {
		$xml = Feed::load($feed['url']);
        $feeds[$index]['xml'] = $xml;
	}
	catch(FeedException | Exception $e) {
        $errors[] = get_class($e) . ": " . $e->getMessage() . " - " . $feed['url'];
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

        <div class="page-errors">
            <h2>Error(s)</h2>

            <?php if (count($errors) > 0): ?>
                <ul>
                    <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
        </div>

        <div class="two-columns">
        	<?php foreach ($feeds as $feed): ?>
                <p><?= $feed['title'] ?></p>
            <?php  endforeach; ?>
        </div>
    </main>

</body>
</html>

