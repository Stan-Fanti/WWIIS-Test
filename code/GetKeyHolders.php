<?php

$database_user = "test";
$database_password = "testP$ssw0rd";

$pdo = new PDO('host=localhost;dbname=test', $database_user, $database_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM, PDO::ATTR_AUTOCOMMIT => 1, PDO::ATTR_STRINGIFY_FETCHES => 1));

try {
$query = $pdo->query("SELECT name, key FROM key_holders WHERE active = 1 ORDER BY order");
$contacts = $query->fetchAll();

foreach($contacts as $contact) {
$telephone = $pdo->prepare("SELECT telephone FROM contact_details WHERE name = ?");
$telephone->execute($contact['name']);
$telephone = $telephone->fetchColumn();
print("%s %d %s\n", $contact['name'], $contact['telephone'], $contact['key'])}

} catch(Exception $exception) {
echo "An exception occurred!";
}

?>