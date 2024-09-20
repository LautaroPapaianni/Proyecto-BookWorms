<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
include "header.php";
include "database.php";
?>

<head>
    <link href="login-register.css" rel="stylesheet">
</head>
<title>BookWorms | Registrarse</title>

<body>
    <div class="register-form">
        <?php
        if(isset($_POST["submit"])){
            $email = $_POST["email"];
            $nombre = $_POST["nombre"];
            $contrasenia = $_POST["contrasenia"];
            $repetirContrasenia = $_POST["repetir_contrasenia"];
            
            $errores = array();

            if (empty($email) OR empty($nombre) OR empty($contrasenia) OR empty($repetirContrasenia)) {
                array_push($errores, "Debe llenar todos los campos");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errores, "El correo no es valido");
            }
            if (strlen($contrasenia)<8) {
                array_push($errores, "La contraseña debe tener al menos 8 caracteres");
            }
            if ($contrasenia!=$repetirContrasenia) {
                array_push($errores, "Las contraseñas no coinciden");
            }
            if (count($errores)>0) {
                foreach ($errores as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            require_once "database.php";
            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errores,"Email already exists!");
            }
            if (count($errores)>0) {
            foreach ($errores as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            }else{
            $sql = "INSERT INTO usuarios (email, nombre, contrasenia) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss", $email, $nombre, $contrasenia);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Se registro correctamente.</div>";
                header("Locate: index.php");
            }else{
                die("Algo no anda bien");
            }
            }
        }
        ?>
        <form action="register.php" method="post">
            <div class="mb-3 register-form-div">
                <label for="Email" class="form-label">Direccion de correo</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 register-form-div">
                <label for="Nombre" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3 register-form-div">
                <label for="Password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasenia">
            </div>
            <div class="mb-3 register-form-div">
                <label for="Password" class="form-label">Repetir contraseña</label>
                <input type="password" class="form-control" name="repetir_contrasenia">
            </div>
            <div class="mb-3 form-check register-form-div">
                <input type="checkbox" class="form-check-input" id="stay-logged">
                <label class="form-check-label" for="stay-logged">Mantener sesion iniciada</label>
            </div>
            <div class="mb-3 form-check register-form-div">
                <input type="checkbox" class="form-check-input" id="accept-terms">
                <label class="form-check-label" for="accept-terms">Acepto los teminos y condiciones</label>
            </div>
            <div class="form-btn">
                <button type="submit" class="btn btn-primary register-form-div" value="Register" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
<?php
include "footer.php";
?>