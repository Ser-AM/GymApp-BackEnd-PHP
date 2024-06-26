<?php
namespace Serj\GymAppBack\Controllers;

use Serj\GymAppBack\Models\EjercicioRutina;
use PDO;

class EjercicioRutinaController {
    private $ejercicioRutinaModel;

    public function __construct(EjercicioRutina $ejercicioRutinaModel) {
        $this->ejercicioRutinaModel = $ejercicioRutinaModel;
    }

    public function validarDatos($data) {
        if (!isset($data['orden']) || !is_numeric($data['orden'])) {
            throw new \Exception('El orden es obligatorio y debe ser un número.');
        }
        if (!isset($data['series']) || !is_numeric($data['series'])) {
            throw new \Exception('Las series son obligatorias y deben ser un número.');
        }
        if (!isset($data['repeticiones']) || !is_numeric($data['repeticiones'])) {
            throw new \Exception('Las repeticiones son obligatorias y deben ser un número.');
        }
        if (!isset($data['descanso']) || !is_numeric($data['descanso'])) {
            throw new \Exception('El descanso es obligatorio y debe ser un número.');
        }
    }

    public function agregarEjercicioARutina($rutina_id, $ejercicio_id, $orden, $series, $repeticiones, $descanso) {
        $this->validarDatos(compact('rutina_id', 'ejercicio_id', 'orden', 'series', 'repeticiones', 'descanso'));
        return $this->ejercicioRutinaModel->agregarEjercicioARutina($rutina_id, $ejercicio_id, $orden, $series, $repeticiones, $descanso);
    }

    public function obtenerEjerciciosDeRutina($rutina_id) {
        return $this->ejercicioRutinaModel->obtenerEjerciciosDeRutina($rutina_id);
    }

    public function actualizarEjercicioEnRutina($id, $orden, $series, $repeticiones, $descanso) {
        $this->validarDatos(compact('id', 'orden', 'series', 'repeticiones', 'descanso'));
        $this->ejercicioRutinaModel->actualizarEjercicioEnRutina($id, $orden, $series, $repeticiones, $descanso);
    }

    public function eliminarEjercicioDeRutina($id) {
        return $this->ejercicioRutinaModel->eliminarEjercicioDeRutina($id);
    }
}
