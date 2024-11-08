<?php  
session_start();

if(isset($_POST['nombre'])){

    include "database.php";

    $nombre = $_POST['nombre'];
    $foto_vieja = $_POST['foto_vieja'];
    $id = $_SESSION['id_usuario'];

    if (empty($nombre)) {
    	$em = "Es necesario un nombre";
    	header("Location: ../perfil.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['foto_perfil']['name']) AND !empty($_FILES['foto_perfil']['name'])) {
        
         $img_name = $_FILES['foto_perfil']['name'];
         $tmp_name = $_FILES['foto_perfil']['tmp_name'];
         $error = $_FILES['foto_perfil']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($nombre, true).'.'.$img_ex_to_lc;
               $img_upload_path = '../img/'.$new_img_name;
               $old_pp_des = "../img/$foto_vieja";
               move_uploaded_file($tmp_name, $img_upload_path);
               
               
               $sql = "UPDATE usuarios 
                       SET nombre=?, foto_perfil=?
                       WHERE id_usuario=?";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("ssi", $nombre, $new_img_name, $id);
               $stmt->execute();
               $_SESSION['nombre'] = $nombre;
               header("Location: ../perfil.php?success=Your account has been updated successfully");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: ../perfil.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: ../perfil.php?error=$em&$data");
            exit;
         }

        
      }else {
       	$sql = "UPDATE usuarios 
       	        SET nombre=?
                WHERE id_usuario=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$nombre, $id]);

       	header("Location: ../perfil.php?success=Your account has been updated successfully");
   	    exit;
      }
    }


}else {
	header("Location: ../perfil.php?error=error");
	exit;
}