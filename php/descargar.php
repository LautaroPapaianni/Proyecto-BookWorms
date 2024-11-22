<?php
session_start();
include 'database.php';

// Log para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función de logging
function logMessage($message) {
    file_put_contents('descargar_log.txt', date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
}

logMessage("Inicio de descarga. GET: " . print_r($_GET, true));

if (!isset($_SESSION['user'])) {
    logMessage("No autorizado");
    http_response_code(403);
    die("No autorizado");
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    logMessage("ID de archivo no proporcionado");
    http_response_code(400);
    die("ID de archivo no proporcionado");
}

$id_archivo = intval($_GET['id']);
logMessage("ID de archivo recibido: $id_archivo");

$stmt = $conn->prepare("SELECT titulo, archivo FROM archivos WHERE id_archivo = ?");
$stmt->bind_param("i", $id_archivo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    logMessage("Archivo no encontrado para ID: $id_archivo");
    http_response_code(404);
    die("Archivo no encontrado");
}

$archivo = $result->fetch_assoc();
logMessage("Archivo encontrado: " . $archivo['titulo']);

if (empty($archivo['archivo'])) {
    logMessage("Contenido del archivo vacío");
    http_response_code(400);
    die("El contenido del archivo está vacío");
}

// Establecer headers para mostrar el PDF en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $archivo['titulo'] . '"');
header('Content-Length: ' . strlen($archivo['archivo']));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

logMessage("Enviando archivo: " . $archivo['titulo']);
echo $archivo['archivo'];
exit();