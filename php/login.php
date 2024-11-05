<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: ../index.php");
   exit;
}
?>

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
    $_SESSION['id_usuario'] = $user['id_usuario'];
    if ($user) {
        $id = $user['id_usuario'];
        if ($contrasenia == $user["contrasenia"]) {
            // La contraseña coincide, iniciar sesión
            $_SESSION["user"] = "yes";
            header("Location: ../index.php");
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
?>