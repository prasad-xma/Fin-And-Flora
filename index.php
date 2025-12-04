<?php
require 'vendor/autoload.php';

$mongo_host = getenv('MONGO_HOST') ?: 'fin-mongo';

echo "<h1>PHP and MongoDB Docker Setup Check</h1>";

try {
    $client = new MongoDB\Client("mongodb://$mongo_host:27017");

    $db = $client->selectDatabase('testdb');
    $collection = $db->selectCollection('testcollection');

    $result = $collection->insertOne([
        'message' => 'Hello from Docker!',
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);

    echo "<p style='color: green;'>Connected to MongoDB!</p>";
    echo "<p>Inserted ID: " . $result->getInsertedId() . "</p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>MongoDB Connection Failed:</p>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
