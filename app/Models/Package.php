<?php

class Package {
    public $id;
    public $name;
    public $description;

    public function __construct() {
    }

    public static function getAllPackages($pdo) {
        if (!$pdo) return false;

        $pdo_stmt = $pdo->query("SELECT * FROM packages_lib");
        $pdo_stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Package');
        $packages = $pdo_stmt->fetchAll();

        return $packages;
    }

    public static function getPackageById($pdo, $id) {
        if (!$pdo || !$id) return false;

        $pdo_stmt = $pdo->query("SELECT * FROM packages_lib WHERE id = {$id}");
        $pdo_stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
        $consultant = $pdo_stmt->fetch();

        return $consultant;
    }

    public static function updatePackage($pdo, $id, $name, $description) {
        if (!$pdo || !$id) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'name' => 'Nazwa jest wymagana.',
            'description' => 'Opis jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $pdo_stmt = $pdo->prepare("UPDATE packages_lib SET name = :name, description = :description WHERE id = :id");
        $pdo_stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $pdo_stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $pdo_stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie zaktualizowano pakiet.';
            $status = 'success';
            return ['status' => $status, 'messages' => $success];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas aktualizacji pakietu.';
            return ['status' => $status, 'messages' => $errors];
        }
    }

    public static function createPackage($pdo, $name, $description) {
        if (!$pdo) return false;

        $errors = [];
        $status = 'error';

        $check_table = [
            'name' => 'Nazwa jest wymagana.',
            'description' => 'Opis jest wymagany.'
        ];
        foreach ($check_table as $field => $error) {
            if (!$$field) {
                $errors[$field] = $error;
            }
        }
        if (!empty($errors)) {
            return ['status' => $status, 'messages' => $errors];
        }

        $pdo_stmt = $pdo->prepare("INSERT INTO packages_lib (name, description) VALUES (:name, :description)");
        $pdo_stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $pdo_stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie dodano pakiet.';
            $status = 'success';
            $id = $pdo->lastInsertId();
            return ['status' => $status, 'messages' => $success, 'id' => $id];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas dodawania pakietu.';
            return ['status' => $status, 'messages' => $errors];
        }
    }

    public static function deletePackage($pdo, $id) {
        if (!$pdo || !$id) return false;
        $status = 'error';

        $pdo_stmt = $pdo->prepare("DELETE FROM packages_lib WHERE id = :id");
        $pdo_stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($pdo_stmt->execute()) {
            $success['success'] = 'Pomyślnie usunięto pakiet.';
            $status = 'success';
            return ['status' => $status, 'messages' => $success];
        } 
        else {
            $errors['update'] = 'Wystąpił błąd podczas usuwania pakietu.';
            return ['status' => $status, 'messages' => $errors];
        }
    }
}