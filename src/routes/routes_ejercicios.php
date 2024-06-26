<?php
use Serj\GymAppBack\Controllers\EjercicioController;
use Serj\GymAppBack\Models\Ejercicio;

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
$ejercicioModel = new Ejercicio($pdo);
$ejercicioController = new EjercicioController($ejercicioModel);

// Definir las rutas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insertarEjercicio') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
        exit;
    }
    try {
        $id = $ejercicioController->insertarEjercicio($data['nombre'], $data['descripcion']);
        echo json_encode(['status' => 'success', 'id' => $id]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'obtenerTodosEjercicios') {
    $ejercicios = $ejercicioController->obtenerTodosEjercicios();
    echo json_encode($ejercicios);
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'obtenerEjercicio' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $ejercicio = $ejercicioController->obtenerEjercicioPorId($id);
        if ($ejercicio) {
            echo json_encode(['status' => 'success', 'ejercicio' => $ejercicio]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ejercicio no encontrado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['action'] == 'actualizarEjercicio' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $ejercicioController->actualizarEjercicio($id, $data['nombre'], $data['descripcion']);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['action'] == 'eliminarEjercicio' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $ejercicioController->eliminarEjercicio($id);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
