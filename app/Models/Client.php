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

        $client->address_formatted = self::getAddress($client, true);
        $client->consultant_ids = self::getClientConsultants($pdo, $id);
        $client->package_id = self::getClientPackage($pdo, $id);

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

    public static function updateClientConsultants($pdo, $id, $consultants_ids) {
        if (!$pdo || !$id || !$consultants_ids) return false;

        $existing_consultants = self::getClientConsultants($pdo, $id);

        $consultants_to_remove = ($existing_consultants) ? array_diff($existing_consultants, $consultants_ids) : [];
        if (!empty($consultants_to_remove)) {
            $placeholders = implode(',', array_fill(0, count($consultants_to_remove), '?'));
            $stmt = $pdo->prepare("DELETE FROM connections_clients_consultants WHERE client_id = ? AND consultant_id IN ($placeholders)");
            $stmt->execute(array_merge([$id], $consultants_to_remove));
        }

        $consultants_to_add = ($existing_consultants) ? array_diff($consultants_ids, $existing_consultants) : $consultants_ids;        
        if (!empty($consultants_to_add)) {
            $stmt = $pdo->prepare("INSERT INTO connections_clients_consultants (client_id, consultant_id) VALUES " . 
            implode(',', array_fill(0, count($consultants_to_add), "(?, ?)")));
            $params = [];
            foreach ($consultants_to_add as $consultant_id) {
                $params[] = $id;
                $params[] = $consultant_id;
            }
            if (!empty($params)) {
                $stmt->execute($params);
            }
        }
    }

    public static function getClientConsultants($pdo, $id) {
        if (!$pdo || !$id) return false;

        $stmt = $pdo->prepare("SELECT consultant_id FROM connections_clients_consultants WHERE client_id = :client_id");
        $stmt->execute(['client_id' => $id]);
        $consultants = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $consultants;
    }

    public static function updateClientPackage($pdo, $id, $package_id) {
        if (!$pdo || !$id || !$package_id) return false;

        $exists = self::getClientPackage($pdo, $id);

        if (!$exists) {        
            $stmt = $pdo->prepare("INSERT INTO connections_clients_packages (client_id, package_id) VALUES (:client_id, :package_id)");
            $stmt->execute([
                'client_id' => $id,
                'package_id' => $package_id,
            ]);
        }
        else {
            $stmt = $pdo->prepare("UPDATE connections_clients_packages SET package_id = :package_id WHERE client_id = :client_id");
            $stmt->execute([
                'client_id' => $id,
                'package_id' => $package_id,
            ]);
        }
    }

    public static function getClientPackage($pdo, $id) {
        if (!$pdo || !$id) return false;

        $stmt = $pdo->prepare("SELECT package_id FROM connections_clients_packages WHERE client_id = :client_id");
        $stmt->execute(['client_id' => $id]);
        $package_id = $stmt->fetchColumn();

        return $package_id;
    }

    public static function updateClientContactData($pdo, $id, $contacts) {
        if (!$pdo || !$id || !$contacts) return false;
        
        $contacts = serialize($contacts);
        $check_contacts = self::getClientContactData($pdo, $id);

        if ($check_contacts) {
            $stmt = $pdo->prepare("UPDATE clients_meta SET meta_value = :meta_value WHERE meta_key = 'contacts' AND parent_id = :parent_id");
            $stmt->execute([
                'meta_value' => $contacts,
                'parent_id' => $id,
            ]);
        }
        else {
            $stmt = $pdo->prepare("INSERT INTO clients_meta (meta_key, meta_value, parent_id) VALUES ('contacts', :meta_value, :parent_id)");
            $stmt->execute([
                'meta_value' => $contacts,
                'parent_id' => $id,
            ]);
        }
    }

    public static function getClientContactData($pdo, $id) {
        if (!$pdo || !$id) return false;
        
        $stmt = $pdo->prepare("SELECT meta_value FROM clients_meta WHERE meta_key = 'contacts' AND parent_id = :parent_id");
        $stmt->execute(['parent_id' => $id]);
        $meta = $stmt->fetchColumn();

        return unserialize($meta);
    }
}