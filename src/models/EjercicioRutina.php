<?php
namespace Serj\GymAppBack\Models;

use PDO;

class EjercicioRutina {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function agregarEjercicioARutina($rutina_id, $ejercicio_id, $orden, $series, $repeticiones, $descanso) {
        $sql = "INSERT INTO r01_ejercicios_rutinas (rutina_id, ejercicio_id, orden, series, repeticiones, descanso) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rutina_id, $ejercicio_id, $orden, $series, $repeticiones, $descanso]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerEjerciciosDeRutina($rutina_id) {
        $sql = "SELECT * FROM r01_ejercicios_rutinas WHERE rutina_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rutina_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEjercicioEnRutina($id, $orden, $series, $repeticiones, $descanso) {
        $sql = "UPDATE r01_ejercicios_rutinas SET orden = ?, series = ?, repeticiones = ?, descanso = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orden, $series, $repeticiones, $descanso, $id]);
    }

    public function eliminarEjercicioDeRutina($id) {
        $sql = "DELETE FROM r01_ejercicios_rutinas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
