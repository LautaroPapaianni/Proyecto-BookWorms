<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
include "header.php";
?>
<title>BookWorms | Inicio</title>
<?php
include "footer.php";
?>