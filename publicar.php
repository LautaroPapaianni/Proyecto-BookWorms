<?php 
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
include 'header.php';
include 'php/database.php';
?>
<title>BookWorms | Publicar</title>
<div class="container">
    <div class="header-section">
        <h1>Upload Files</h1>
        <p>Upload files you want to share with your team members.</p>
        <p>PDF are allowed.</p>
    </div>
    <div class="drop-section">
        <div class="col">
            <div class="cloud-icon">
                <img src="img/icons/cloud.png" alt="cloud">
            </div>
            <span>Drag & Drop your files here</span>
            <span>OR</span>
            <button class="file-selector">Browse Files</button>
            <input type="file" id="fileInput" name="file[]" class="file-selector-input" multiple>
        </div>
        <div class="col">
            <div class="drop-here">Drop Here</div>
        </div>
    </div>
    <div class="list-section">
        <div class="list-title">Uploaded Files</div>
        <div class="list"></div>
    </div>
    <button type="button" class="btn btn-primary" onclick="subirArchivo()">Subir Archivo</button>
</div>
<?php
include "footer.php";
?>
    <script src="js/publicar.js"></script>
