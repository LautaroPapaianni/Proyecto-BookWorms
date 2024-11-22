<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
include "header.php";

$id_usuario_sesion = $_SESSION['id_usuario'];
?>
<script>
    // Pasar el ID del usuario a JavaScript
    var idUsuarioSesion = <?php echo json_encode($id_usuario_sesion); ?>;
</script>
<title>BookWorms | Inicio</title>
<table id="archivosTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Nombre del Archivo</th>
            <th>Tamaño</th>
            <th>Subido por</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Previsualización de PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <iframe id="pdfViewer" style="width: 100%; height: 800px;" frameborder="0" src=""></iframe>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>