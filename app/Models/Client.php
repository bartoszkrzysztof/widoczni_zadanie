<?php
require_once 'Users.php';

class Client {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $postal_code;
    public $country;
    public $meta;

    public function __construct() {
    }

    public static function getAllClients($pdo) {
        if (!$pdo) return false;

        $clients = Users::getAll($pdo, 'clients');

        return $clients;
    }

    public static function getClientById($pdo, $id) {
        if (!$pdo || !$id) return false;

        $client = Users::getById($pdo, $id, 'clients');

        $client->address_formatted = Client::getAddress($client, true);

        return $client;
    }

    public static function getAddress($client, $format = false) {
        if ($format) {
            return htmlspecialchars($client->address) . ', <br />' . htmlspecialchars($client->postal_code) . ' ' . htmlspecialchars($client->city) . ', ' . htmlspecialchars($client->country);
        } 
        else {
            return htmlspecialchars($client->address . ' ' . $client->postal_code . ' ' . $client->city . ' ' . $client->country);
        }   
    }

    // public function setName($name) {
    //     $this->name = $name;
    // }

    // public function setEmail($email) {
    //     $this->email = $email;
    // }

    // public static function getById($id) {
    //     // Logic to retrieve a client by ID from the database
    // }

    // public function save() {
    //     // Logic to save a new client to the database
    // }

    // public function update($id) {
    //     // Logic to update an existing client in the database
    // }

    // public function delete($id) {
    //     // Logic to delete a client from the database
    // }
}