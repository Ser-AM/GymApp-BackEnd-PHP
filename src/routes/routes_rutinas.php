<?php
use Serj\GymAppBack\Controllers\RutinaController;
use Serj\GymAppBack\Models\Rutina;

// Cargar las dependencias necesarias
require_once '../vendor/autoload.php';
require_once '../src/config/config.php';

// Configurar la conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    die();
}

// Crear una instancia del modelo y del controlador
$rutinaModel = new Rutina($pdo);
$rutinaController = new RutinaController($rutinaModel);

// Definir las rutas para rutinas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insertarRutina') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
        exit;
    }
    try {
        $id = $rutinaController->insertarRutina($data['nombre'], $data['descripcion']);
        echo json_encode(['status' => 'success', 'id' => $id]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'obtenerTodasRutinas') {
    $rutinas = $rutinaController->obtenerTodasRutinas();
    echo json_encode($rutinas);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'obtenerRutina' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $rutina = $rutinaController->obtenerRutinaPorId($id);
        if ($rutina) {
            echo json_encode(['status' => 'success', 'rutina' => $rutina]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Rutina no encontrada.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['action'] == 'actualizarRutina' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $rutinaController->actualizarRutina($id, $data['nombre'], $data['descripcion']);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['action'] == 'eliminarRutina') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'])) {
        $id = $data['id'];
        try {
            $rutinaController->eliminarRutina($id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
}
