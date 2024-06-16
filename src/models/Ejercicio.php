<?php
namespace Serj\GymAppBack\Models;

use PDO;

class Ejercicio {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertarEjercicio($nombre, $descripcion, $urlImagen, $orden, $activo) {
        $sql = "INSERT INTO T006_EJERCICIOS (T_NOMBRE, T_DESCRIPCION, T_URL_IMAGEN, I_ORDEN, I_ACTIVO) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $urlImagen, $orden, $activo]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerTodosEjercicios() {
        $sql = "SELECT ID, T_NOMBRE, T_DESCRIPCION, T_URL_IMAGEN, I_ORDEN, I_ACTIVO FROM T006_EJERCICIOS ORDER BY I_ORDEN";
        $stmt = $this->pdo->query($sql);
        $ejercicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ejercicios;
    }
    

    public function obtenerEjercicioPorId($id) {
        $sql = "SELECT ID, T_NOMBRE, T_DESCRIPCION, T_URL_IMAGEN, I_ORDEN, I_ACTIVO FROM T006_EJERCICIOS WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEjercicio($id, $nombre, $descripcion, $urlImagen, $orden, $activo) {
        $sql = "UPDATE T006_EJERCICIOS SET T_NOMBRE = :nombre, T_DESCRIPCION = :descripcion, T_URL_IMAGEN = :urlImagen, I_ORDEN = :orden, I_ACTIVO = :activo WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':urlImagen', $urlImagen);
        $stmt->bindParam(':orden', $orden, PDO::PARAM_INT);
        $stmt->bindParam(':activo', $activo, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public function eliminarEjercicio($id) {
        $sql = "DELETE FROM T006_EJERCICIOS WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
