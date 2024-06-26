<?php
namespace Serj\GymAppBack\Controllers;

use Serj\GymAppBack\Models\Rutina;

class RutinaController {
    private $rutinaModel;

    public function __construct(Rutina $rutinaModel) {
        $this->rutinaModel = $rutinaModel;
    }

    public function validarDatos($data) {
        // Validar que nombre no esté vacío
        if (empty($data['nombre'])) {
            throw new \Exception('El nombre es obligatorio.');
        }

        // Validar que descripción no esté vacía
        if (empty($data['descripcion'])) {
            throw new \Exception('La descripción es obligatoria.');
        }
    }

    public function insertarRutina($nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        return $this->rutinaModel->insertarRutina($nombre, $descripcion);
    }

    public function obtenerTodasRutinas() {
        return $this->rutinaModel->obtenerTodasRutinas();
    }

    public function obtenerRutinaPorId($id) {
        return $this->rutinaModel->obtenerRutinaPorId($id);
    }

    public function actualizarRutina($id, $nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        $this->rutinaModel->actualizarRutina($id, $nombre, $descripcion);
    }

    public function eliminarRutina($id) {
        return $this->rutinaModel->eliminarRutina($id);
    }
}
