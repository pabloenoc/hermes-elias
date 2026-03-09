<?php

require __DIR__ . '/../vendor/autoload.php';

$db = new SQLite3(__DIR__ . '/../db/hermes_development.sqlite');


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_feed_url'])) {
	$errors = [];

	$url = trim($_POST['new_feed_url']);

	try {
		$xml = Feed::load($url);
		$feed_format = $xml->item ? 'rss' : 'atom';
		$feed_title = $xml->title;
	} catch(Exception $e) {
		$errors[] = $e->getMessage();
	}

	if (empty($errors)) {
		// TODO: Save the feed to the database

		$stmt = $db->prepare("INSERT OR IGNORE INTO feeds (title, url, format) VALUES (:title, :url, :format)");

		$stmt->bindValue(':title', $feed_title, SQLITE3_TEXT); // TODO: Create this variable lol
		$stmt->bindValue(':url', $url, SQLITE3_TEXT);
		$stmt->bindValue(':format', $feed_format, SQLITE3_TEXT); // TODO: Create this variable lol
		$stmt->execute();
	}


}

?>

<form method="post">
	<input type="url" placeholder="https://example.com" name="new_feed_url">
	<input type="submit" value="+">
</form>
