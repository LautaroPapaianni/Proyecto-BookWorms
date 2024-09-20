<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit;
}
?>

<head>
    <link href="login-register.css" rel="stylesheet">
    <link rel="icon" href="/Aplicaciones Interactivas/Proyecto BookWorms/img/BookWorms-favicon.png" sizes="128x128"
        type="image/x-icon">
</head>
<title>BookWorms | Iniciar sesion</title>

<body>
    <div class="login-form">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $contrasenia = $_POST["contrasenia"];
            require_once "database.php";
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if ($user) {
                if ($contrasenia == $user["contrasenia"]) {
                    // La contraseña coincide, iniciar sesión
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    exit;
                } else {
                    // La contraseña no coincide
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                // El email no existe
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        include "header.php";
        include "database.php";
        ?>
        <form action="login.php" method="post" id="login-form">
        <div class="mb-3 login-form-div">
            <label for="Email" class="form-label">Direccion de correo</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 login-form-div">
            <label for="Password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contrasenia" id="contrasenia">
        </div>
        <div class="mb-3 form-check login-form-div">
            <input type="checkbox" class="form-check-input" id="stay-logged">
            <label class="form-check-label" for="stay-logged">Mantener sesion iniciada</label>
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary login-form-div" value="Login" name="login">Submit</button>
        </div>
        <div class="text-center mb-3 ">Si no tienes cuenta puedes registrarte <a href="register.php"><kbd>aqui</kbd></a>
        </div>
        </form>
    </div>
</body>
<?php
include "footer.php";
?>