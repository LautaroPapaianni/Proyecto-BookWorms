<?php
include 'database.php';

// Obtener término de búsqueda si existe
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Modificar la consulta para incluir búsqueda
$sql = "SELECT archivos.id_archivo, archivos.titulo, LENGTH(archivos.archivo) AS tamano, usuarios.nombre AS usuario
        FROM archivos
        INNER JOIN usuarios ON archivos.id_usuario = usuarios.id_usuario
        WHERE archivos.titulo LIKE ? OR usuarios.nombre LIKE ?";

$stmt = $conn->prepare($sql);
$searchParam = "%{$searchTerm}%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = array(
        'id_archivo' => $row['id_archivo'],
        'titulo' => $row['titulo'],
        'tamano' => round($row['tamano'] / 1024, 2) . " KB",
        'usuario' => $row['usuario']
    );
}

echo json_encode(array('data' => $data));
$conn->close();
?>