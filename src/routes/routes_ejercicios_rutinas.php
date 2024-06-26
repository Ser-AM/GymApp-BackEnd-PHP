<?php
use Serj\GymAppBack\Controllers\EjercicioRutinaController;
use Serj\GymAppBack\Models\EjercicioRutina;

// Instanciar el modelo y controlador de EjercicioRutina
$ejercicioRutinaModel = new EjercicioRutina($pdo);
$ejercicioRutinaController = new EjercicioRutinaController($ejercicioRutinaModel);

// Definir las rutas para ejercicios en rutinas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'agregarEjercicioARutina') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $id = $ejercicioRutinaController->agregarEjercicioARutina($data['rutina_id'], $data['ejercicio_id'], $data['orden'], $data['series'], $data['repeticiones'], $data['descanso']);
        echo json_encode(['status' => 'success', 'id' => $id]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'obtenerEjerciciosDeRutina' && isset($_GET['rutina_id'])) {
    try {
        $ejercicios = $ejercicioRutinaController->obtenerEjerciciosDeRutina($_GET['rutina_id']);
        echo json_encode(['status' => 'success', 'ejercicios' => $ejercicios]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['action'] == 'actualizarEjercicioEnRutina' && isset($_GET['id'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $ejercicioRutinaController->actualizarEjercicioEnRutina($_GET['id'], $data['orden'], $data['series'], $data['repeticiones'], $data['descanso']);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['action'] == 'eliminarEjercicioDeRutina' && isset($_GET['id'])) {
    try {
        $ejercicioRutinaController->eliminarEjercicioDeRutina($_GET['id']);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}