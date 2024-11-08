<?php
session_start();
include 'database.php';

$id_usuario = $_SESSION['id_usuario']; // ID del usuario en sesión
$response = ["status" => "error", "message" => "No se ha recibido ningún archivo o hubo un error en la carga."];

if (isset($_FILES['file']) && is_array($_FILES['file']['name'])) {
    $uploadSuccess = true;
    foreach ($_FILES['file']['name'] as $index => $name) {
        if ($_FILES['file']['error'][$index] === 0) {
            $fileTmpPath = $_FILES['file']['tmp_name'][$index];
            $fileData = file_get_contents($fileTmpPath);

            $sql = "INSERT INTO archivos (id_usuario, titulo, archivo) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $id_usuario, $name, $fileData);

            if ($stmt->execute()) {
                $response["message"] = "Archivos cargados exitosamente.";
            } else {
                $uploadSuccess = false;
                $response["message"] = "Error al cargar el archivo '$name'.";
                break;
            }
        } else {
            $uploadSuccess = false;
            $response["message"] = "Error en el archivo '$name'.";
            break;
        }
    }
    $response["status"] = $uploadSuccess ? "success" : "error";
}

echo json_encode($response);
?>
