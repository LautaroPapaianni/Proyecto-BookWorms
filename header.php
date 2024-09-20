<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="stylesheet.css" rel="stylesheet">
    <link rel="icon" href="/Aplicaciones Interactivas/Proyecto BookWorms/img/BookWorms-favicon.png" sizes="128x128"
        type="image/x-icon">
</head>

<body>
    <header>
        <!-- <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>
        <div id="main">
            <button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>
            <h2>Collapsed Sidebar</h2>
            <p>Click on the hamburger menu/bar icon to open the sidebar, and push this content to the right.</p>
        </div> -->
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
                        <input placeholder="Search..." type="text">
                        <button type="submit">Go</button>
                    </div>
                    <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                        <?php
                    if (isset($_SESSION["user"])) {
                    ?>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-warning">Logout</a>
                        </li>
                        <?php
                    }
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