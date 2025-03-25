<?php

class Users {
    public $id;
    public $name;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $meta;

    public function __construct() {
    }

    public static function getAll($pdo, $table) {
        if (!$pdo) return false;

        $pdo_stmt = $pdo->query("SELECT * FROM {$table}");
        $pdo_stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
        $consultants = $pdo_stmt->fetchAll();

        foreach ($consultants as $consultant) {
            $consultant->meta = self::getMeta($pdo, $consultant->id, $table);
        }

        return $consultants;
    }

    public static function getById($pdo, $id, $table) {
        if (!$pdo || !$id) return false;

        $pdo_stmt = $pdo->query("SELECT * FROM {$table} WHERE id = {$id}");
        $pdo_stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
        $consultant = $pdo_stmt->fetch();

        if ($consultant) {
            $consultant->meta = self::getMeta($pdo, $consultant->id, $table);
        }

        return $consultant;
    }

    private static function getMeta($pdo, $id, $table) {
        if (!$pdo || !$id) return false;
        $table_name = $table . '_meta';
        $pdo_stmt = $pdo->query("SELECT meta_key, meta_value FROM {$table_name} WHERE parent_id = {$id}");
        $meta = $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);

        return $meta;
    }

    public function getMetaValue($key) {
        if (!$this->meta || !$key) return false;

        $meta_value = array_column(array_filter($this->meta, function($meta) use ($key) {
            return $meta['meta_key'] === $key;
        }), 'meta_value');

        return $meta_value;
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