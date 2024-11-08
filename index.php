<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
include "header.php";
?>
<title>BookWorms | Inicio</title>
<h2>Archivos PDF Cargados</h2>
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
<?php
include "footer.php";
?>