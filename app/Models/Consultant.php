<?php
require_once 'Users.php';

class Consultant {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $meta;

    public function __construct() {
    }

    public static function getAllConsultants($pdo) {
        if (!$pdo) return false;

        $consultants = Users::getAll($pdo, 'consultants');

        return $consultants;
    }

    public static function getConsultantById($pdo, $id) {
        if (!$pdo || !$id) return false;

        $consultant = Users::getById($pdo, $id, 'consultants');

        $consultant->full_name = $consultant->first_name . ' ' . $consultant->last_name;

        return $consultant;
    }
    
    public static function updateConsultant($pdo, $id, $first_name, $last_name, $email, $phone) {
        if (!$pdo || !$id) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'first_name' => 'Imię jest wymagane.',
            'last_name' => 'Nazwisko jest wymagane.',
            'email' => 'Email jest wymagany.',
            'phone' => 'Telefon jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $results = Users::update($pdo, $id, 'consultants', [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone
        ]);

        return $results;   
    }

    public static function deleteConsultant($pdo, $id) {
        if (!$pdo || !$id) return false;

        $results = Users::delete($pdo, $id, 'consultants');

        return $results;
    }

    public static function createConsultant($pdo, $first_name, $last_name, $email, $phone) {
        if (!$pdo) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'first_name' => 'Imię jest wymagane.',
            'last_name' => 'Nazwisko jest wymagane.',
            'email' => 'Email jest wymagany.',
            'phone' => 'Telefon jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $results = Users::create($pdo, 'consultants', [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone
        ]);
        
        return $results;   
    }
}