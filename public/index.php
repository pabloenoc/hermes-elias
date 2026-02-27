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

	    <?php if (count($errors) > 0): ?>
		<div class="page-errors">
		   <h2>Error(s)</h2>
                    <ul>
			<?php foreach($errors as $error): ?>
			    <li><?= $error ?></li>
			<?php endforeach; ?>
                    </ul>		    
		</div>
	    <?php endif; ?> 

            <div>
        	<?php foreach ($feeds as $index => $feed): ?>
                    <p><?= $feed['title'] ?></p>

                	<?php if (isset($feed['xml'])): ?>
                	    <?php foreach ($feed['xml']->item as $item): ?>
                		<div class="linkpost">
                		    <a href="<?= $item->link ?>" target="_blank">
                			<?= $item->title ?>
                		    </a>
                		</div>
                	    <?php endforeach; ?>
                	<?php else: ?>
                	    <div style="opacity: 0.5;">No items found.</div>	
                	<?php endif; ?>

		<?php  endforeach; ?>
            </div>
	</main>

    </body>
</html>

