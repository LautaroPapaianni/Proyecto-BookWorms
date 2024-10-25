<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}
include "header.php";
include "database.php";
?>
<head>
    <link href="perfil.css" rel="stylesheet">
</head>

<body>
    <div class="perfil-cuerpo">
        
    </div>
</body>