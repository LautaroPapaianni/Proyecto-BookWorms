<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="stylesheet.css" rel="stylesheet">
    <link rel="icon" href="/Aplicaciones Interactivas/Proyecto BookWorms/BookWorms-favicon.png" sizes="128x128"
        type="image/x-icon">
    <title>BookWorms | Main page</title>
</head>

<body>
    <header>
        <div id="mySidebar" class="sidebar">
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
        </div>
        <nav class="navbar navbar-expand-md fixed-top" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="BookWorms-logo.png" alt="BookWorms" width="100" height="100">
                    BookWorms: Biblioteca online
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="search">
                        <input placeholder="Buscar libros, autores, personas..." class="search__input" type="text" />
                        <button class="search__button">
                            <svg viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" height="16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tú
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Ajustes de la cuenta</a></li>
                            <li><a class="dropdown-item" href="#">Subscripcion</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Biblioteca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Social</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>