<?php 
include 'php/usuario.php';
include 'php/database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="stylesheet.css" rel="stylesheet">
    <link rel="icon" href="img/BookWorms-favicon.png" sizes="128x128"
        type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md fixed-top" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/BookWorms-logo.png" alt="BookWorms" width="100" height="100">
                    BookWorms: Biblioteca online
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse search-bar" id="navbarSupportedContent">
                    <div class="search">
                        <input placeholder="Search..." type="text" id="search-input">
                        <button type="submit" id="search-btn">Go</button>
                    </div>
                    <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                        <?php
                    if (isset($_SESSION["user"])) {
                        $user = getUserById($_SESSION['id_usuario'], $conn);
                    ?>
                        <li class="nav-item">
                            <a href="php/logout.php" class="btn btn-warning">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a href="publicar.php" class="nav-link btn btn-primary">Publicar</a>
                        </li>
                        <?php
                        if ($user['tipo_usuario'] == 0) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" href="perfil.php"><img src="img/<?=$user['foto_perfil']?>"
                 class="rounded-circle"
                 style="width: 35px"><?=$user['nombre']?></a>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" href="perfil.php">Admin</a>
                        </li>
                        <?php
                    }}
                    ?>
                        <?php
                    if (!isset($_SESSION["user"])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" href="login.php">Iniciar Sesion</a>
                        </li>
                        <?php
                    }
                    ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" href="index.php">Inicio</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>