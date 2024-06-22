<?php
namespace Serj\GymAppBack\Models;

use PDO;

class Ejercicio {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertarEjercicio($nombre, $descripcion) {
        $sql = "INSERT INTO T04_EJERCICIOS (T_NOMBRE, T_DESCRIPCION) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerTodosEjercicios() {
        $sql = "SELECT ID, T_NOMBRE, T_DESCRIPCION FROM T04_EJERCICIOS";
        $stmt = $this->pdo->query($sql);
        $ejercicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ejercicios;
    }
    

    public function obtenerEjercicioPorId($id) {
        $sql = "SELECT ID, T_NOMBRE, T_DESCRIPCION FROM T04_EJERCICIOS WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEjercicio($id, $nombre, $descripcion) {
        $sql = "UPDATE T04_EJERCICIOS SET T_NOMBRE = :nombre, T_DESCRIPCION = :descripcion WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();
    }

    public function eliminarEjercicio($id) {
        $sql = "DELETE FROM T04_EJERCICIOS WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
