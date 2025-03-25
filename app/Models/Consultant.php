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

    public static function getAll($pdo) {
        if (!$pdo) return false;

        $consultants = Users::getAll($pdo, 'consultants');

        return $consultants;
    }

    public static function getById($pdo, $id) {
        if (!$pdo || !$id) return false;

        $consultant = Users::getById($pdo, $id, 'consultants');

        $consultant->full_name = $consultant->first_name . ' ' . $consultant->last_name;

        return $consultant;
    }
    
    public function save() {
        // Logic to save a new caregiver to the database
    }

    public function update($id) {
        // Logic to update caregiver information in the database
    }

    public function delete($id) {
        // Logic to delete a caregiver from the database
    }
}