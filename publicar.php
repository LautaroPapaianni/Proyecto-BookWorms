<?php 
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
include 'header.php';
include 'php/database.php';
?>
<head>
  <link rel="stylesheet" href="no-search.css">
</head>
<title>BookWorms | Publicar</title>
<div class="container">
    <div class="header-section">
        <h1>Publicar archivos</h1>
        <p>Agregue los archivos que desee publicar</p>
        <p>Solamente se admiten PDFs</p>
    </div>
    <div class="drop-section">
        <div class="col">
            <div class="cloud-icon">
                <img src="img/icons/cloud.png" alt="cloud">
            </div>
            <span>Arrastre y suelte los archivos que desee cargar</span>
            <span>O</span>
            <button class="file-selector">Buscar archivos</button>
            <input type="file" id="fileInput" name="file[]" class="file-selector-input" multiple>
        </div>
        <div class="col">
            <div class="drop-here">Soltalo aca</div>
        </div>
    </div>
    <div class="list-section">
        <div class="list-title">Archivos cargados</div>
        <div class="list"></div>
    </div>
    <button type="button" class="btn btn-primary" onclick="subirArchivo()">Publicar</button>
</div>
<?php
include "footer.php";
?>
    <script src="js/publicar.js"></script>
