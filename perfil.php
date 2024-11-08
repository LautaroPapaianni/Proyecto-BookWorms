<?php 
session_start();

if (isset($_SESSION['user'])) {
include 'header.php';



 ?>

<title>BookWorms | Perfil</title>

    <?php if ($user) { ?>

    <div class="perfil-form">
        
        <form class="caja shadow w-450 p-3" 
              action="php/perfil.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1 text-light">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
          <div class="mb-3">
            <label class="form-label text-light">Nombre</label>
            <input type="text" 
                   class="form-control"
                   name="nombre"
                   value="<?php echo $user['nombre']?>">
          </div>

          <div class="mb-3">
            <label class="form-label text-light">Profile Picture</label>
            <input type="file" 
                   class="form-control"
                   name="foto_perfil">
            <img src="img/<?=$user['foto_perfil']?>"
                 class="rounded-circle"
                 style="width: 70px">
            <input type="text"
                   hidden="hidden" 
                   name="foto_vieja"
                   value="<?=$user['foto_perfil']?>" >
          </div>
          
          <button type="submit" class="btn btn-primary text-light">Update</button>
        </form>
    </div>
    <?php }else{ 
        header("Location: index.php");
        exit;

    } ?>
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>