<?php
namespace Serj\GymAppBack\Controllers;

use Serj\GymAppBack\Models\Ejercicio;

class EjercicioController {
    private $ejercicioModel;

    public function __construct(Ejercicio $ejercicioModel) {
        $this->ejercicioModel = $ejercicioModel;
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

    public function insertarEjercicio($nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        return $this->ejercicioModel->insertarEjercicio($nombre, $descripcion);
    }

    public function obtenerTodosEjercicios() {
        return $this->ejercicioModel->obtenerTodosEjercicios();
    } 

    public function obtenerEjercicioPorId($id) {
        return $this->ejercicioModel->obtenerEjercicioPorId($id);
    }

    public function actualizarEjercicio($id, $nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        $this->ejercicioModel->actualizarEjercicio($id, $nombre, $descripcion);
    }
    
    public function eliminarEjercicio($id) {
        return $this->ejercicioModel->eliminarEjercicio($id);
    }
}
