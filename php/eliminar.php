<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
    exit;
}

if (isset($_POST['id'])) {
    $id_archivo = intval($_POST['id']);
    $id_usuario = $_SESSION['id_usuario'];

    // Verificar si el archivo pertenece al usuario
    $stmt = $conn->prepare("SELECT id_usuario FROM archivos WHERE id_archivo = ?");
    $stmt->bind_param("i", $id_archivo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $archivo = $result->fetch_assoc();
        if ($archivo['id_usuario'] == $id_usuario) {
            // Eliminar el archivo
            $stmt = $conn->prepare("DELETE FROM archivos WHERE id_archivo = ?");
            $stmt->bind_param("i", $id_archivo);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Archivo eliminado correctamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el archivo.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No tienes permiso para eliminar este archivo.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Archivo no encontrado.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de archivo no proporcionado.']);
}
?>