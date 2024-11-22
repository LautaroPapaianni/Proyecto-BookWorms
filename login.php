<?php
include "header.php";
include "php/database.php";
?>

<head>
    <link href="login-register.css" rel="stylesheet">
</head>
<title>BookWorms | Iniciar sesion</title>

<body>
    <div class="login-form">
        <form action="php/login.php" method="post" id="login-form">
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
            <div class="text-center mb-3 ">Si no tienes cuenta puedes registrarte <a
                    href="register.php"><kbd>aqui</kbd></a>
            </div>
        </form>
    </div>
</body>
<?php
include "footer.php";
?>