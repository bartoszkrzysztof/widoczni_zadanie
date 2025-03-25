<?php

class CaregiverClientAssignment {
    private $db;
    private $table = 'powiązanie_opiekunów_z_klientami';

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllAssignments() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignmentById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createAssignment($caregiverId, $clientId) {
        $query = "INSERT INTO " . $this->table . " (opiekun_id, klient_id) VALUES (:caregiverId, :clientId)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':caregiverId', $caregiverId);
        $stmt->bindParam(':clientId', $clientId);
        return $stmt->execute();
    }

    public function updateAssignment($id, $caregiverId, $clientId) {
        $query = "UPDATE " . $this->table . " SET opiekun_id = :caregiverId, klient_id = :clientId WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':caregiverId', $caregiverId);
        $stmt->bindParam(':clientId', $clientId);
        return $stmt->execute();
    }

    public function deleteAssignment($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}