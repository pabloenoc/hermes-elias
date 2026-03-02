<?php

$db = new SQLite3(__DIR__ . '/../db/hermes_development.sqlite');

if($_SERVER['REQUESTED_METHOD'] === 'POST' && isset($_POST['new_feed.url'])) {
	echo "you sumbitted feed URL" . $_POST['new_feed/url']
}

?>

<form method="post">
	<input type="url" placeholder="https://example.com">
	<input type="submit" value="+">
</form>