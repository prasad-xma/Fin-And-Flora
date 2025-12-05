<?php
namespace FinFlora\Model;

use MongoDB\Client;

class UserModel {
    private $collection;

    public function __construct() {
        $mongo_host = getenv('MONGO_HOST') ?: 'fin-mongo';

        // create mongo client instance 
        $client = new Client("mongodb://$mongo_host:27017");

        // select db and the collection
        $database = $client->selectDatabase('fin_flora_db');
        $this->collection = $database->selectCollection('users');
    }

    public function registerUser($username, $password) {
        $userDocument = [
            'username' => $username,
            'password' => $password,
            // 'created_at' => new \MongoDb\BSON\UTCDateTime(),
            'is_active' => true
        ];

        // insert (register a user)
        $result = $this->collection->insertOne($userDocument);

        return $result;
    }
}


?>