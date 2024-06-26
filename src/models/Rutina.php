<?php
namespace Serj\GymAppBack\Models;

use PDO;

class Rutina {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertarRutina($nombre, $descripcion) {
        $sql = "INSERT INTO t05_rutinas (nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerTodasRutinas() {
        $sql = "SELECT id, nombre, descripcion FROM t05_rutinas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRutinaPorId($id) {
        $sql = "SELECT id, nombre, descripcion FROM t05_rutinas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarRutina($id, $nombre, $descripcion) {
        $sql = "UPDATE t05_rutinas SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();
    }

    public function eliminarRutina($id) {
        $sql = "DELETE FROM t05_rutinas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
