<?php
require_once './config.php';

try {
    // Crear una instancia de la clase PDO para conectar a la base de datos
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    // Configurar el modo de errores de PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configurar el juego de caracteres a UTF-8
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Si hay algún error al conectar, captura la excepción y muestra un mensaje de error
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>
