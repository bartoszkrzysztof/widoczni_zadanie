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
    
    public static function updateClient($pdo, $id, $name, $email, $phone, $address, $city, $postal_code, $country) {
        if (!$pdo || !$id) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'name' => 'Nazwa jest wymagana.',
            'email' => 'Email jest wymagany.',
            'phone' => 'Telefon jest wymagany.',
            'address' => 'Adres jest wymagany.',
            'city' => 'Miasto jest wymagane.',
            'postal_code' => 'Kod pocztowy jest wymagany.',
            'country' => 'Kraj jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $results = Users::update($pdo, $id, 'clients', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'postal_code' => $postal_code,
            'country' => $country
        ]);

        return $results;   
    }

    public static function deleteClient($pdo, $id) {
        if (!$pdo || !$id) return false;

        $results = Users::delete($pdo, $id, 'clients');

        return $results;
    }

    public static function createClient($pdo, $name, $email, $phone, $address, $city, $postal_code, $country) {
        if (!$pdo) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'name' => 'Nazwa jest wymagana.',
            'email' => 'Email jest wymagany.',
            'phone' => 'Telefon jest wymagany.',
            'address' => 'Adres jest wymagany.',
            'city' => 'Miasto jest wymagane.',
            'postal_code' => 'Kod pocztowy jest wymagany.',
            'country' => 'Kraj jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $results = Users::create($pdo, 'clients', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'postal_code' => $postal_code,
            'country' => $country
        ]);
        
        return $results;   
    }
}