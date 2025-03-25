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

    public static function update($pdo, $id, $table, $data) {
        if (!$pdo || !$id) return false;

        $status = 'error';
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key} = '{$value}',";
        }
        $fields = rtrim($fields, ',');
        $pdo_stmt = $pdo->prepare("UPDATE {$table} SET {$fields} WHERE id = {$id}");
        
        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie zaktualizowano.';
            $status = 'success';
            return ['status' => $status, 'messages' => $success];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas aktualizacji.';
            return ['status' => $status, 'messages' => $errors];
        }
    }

    public static function create($pdo, $table, $data) {
        if (!$pdo) return false;

        $errors = [];
        $status = 'error';
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key} = '{$value}',";
        }
        $fields = rtrim($fields, ',');
        $pdo_stmt = $pdo->prepare("INSERT INTO {$table} SET {$fields}");

        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie dodano.';
            $status = 'success';
            $id = $pdo->lastInsertId();
            return ['status' => $status, 'messages' => $success, 'id' => $id];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas dodawania.';
            return ['status' => $status, 'messages' => $errors];
        }
    }
    
    public static function delete($pdo, $id, $table) {
        if (!$pdo || !$id) return false;
        $status = 'error';

        $pdo_stmt = $pdo->prepare("DELETE FROM {$table} WHERE id = :id");
        $pdo_stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie usunięto.';
            $status = 'success';
            return ['status' => $status, 'messages' => $success];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas usuwania.';
            return ['status' => $status, 'messages' => $errors];
        }
    }
}