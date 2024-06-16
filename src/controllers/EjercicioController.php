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
            throw new Exception('El nombre es obligatorio.');
        }

        // Validar que descripción no esté vacía
        if (empty($data['descripcion'])) {
            throw new Exception('La descripción es obligatoria.');
        }

        // Validar que orden sea un número entero
        if (!is_int($data['orden'])) {
            throw new Exception('El orden debe ser un número entero.');
        }

        // Validar que activo sea 0 o 1
        if (!in_array($data['activo'], [0, 1])) {
            throw new Exception('El campo Activo debe ser 0 o 1.');
        }
    }

    // Método para manejar la inserción de un nuevo ejercicio
    public function insertarEjercicio($nombre, $descripcion, $urlImagen, $orden, $activo) {
        $this->validarDatos(compact('nombre', 'descripcion', 'urlImagen', 'orden', 'activo'));
        return $this->ejercicioModel->insertarEjercicio($nombre, $descripcion, $urlImagen, $orden, $activo);
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
    public function actualizarEjercicio($id, $nombre, $descripcion, $urlImagen, $orden, $activo) {
        $this->validarDatos(compact('nombre', 'descripcion', 'urlImagen', 'orden', 'activo'));
        $this->ejercicioModel->actualizarEjercicio($id, $nombre, $descripcion, $urlImagen, $orden, $activo);
    }
    
    // Método para manejar la eliminación de un ejercicio
    public function eliminarEjercicio($id) {
        return $this->ejercicioModel->eliminarEjercicio($id);
    }
}
