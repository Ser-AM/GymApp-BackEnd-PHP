<?php
namespace Serj\GymAppBack\Controllers;

use Serj\GymAppBack\Models\Ejercicio;
use PDO;

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

    // Método para manejar la inserción de un nuevo ejercicio
    public function insertarEjercicio($nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        return $this->ejercicioModel->insertarEjercicio($nombre, $descripcion);
    }

    // Método para manejar la obtención de todos los ejercicios
    public function obtenerTodosEjercicios() {
        return $this->ejercicioModel->obtenerTodosEjercicios();
    } 

    // Método para manejar la obtención de un ejercicio por ID
    public function obtenerEjercicioPorId($id) {
        return $this->ejercicioModel->obtenerEjercicioPorId($id);
    }

    // Método para manejar la actualización de un ejercicio
    public function actualizarEjercicio($id, $nombre, $descripcion) {
        $this->validarDatos(compact('nombre', 'descripcion'));
        $this->ejercicioModel->actualizarEjercicio($id, $nombre, $descripcion);
    }
    
    // Método para manejar la eliminación de un ejercicio
    public function eliminarEjercicio($id) {
        return $this->ejercicioModel->eliminarEjercicio($id);
    }
}
