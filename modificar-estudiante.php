<?php 

$servername = "fdb27.runhosting.com";
$username = "3806697_pruebas";
$password = "Az#12345678#";
$dbname = "3806697_pruebas";

if($_SERVER['REQUEST_METHOD']=="GET")
{
          $dni=$_GET['dni'];
          $nombre = $_GET['nombre'];
          $apellidos =  $_GET['apellidos'];
          $edad = $_GET['edad'];
}
else
{
     // Crear conexión
     $conn = new mysqli($servername, $username, $password, $dbname);
     
     // Comprobar conexión
     if ($conn->connect_error) 
     {
          die("Connection failed: " . $conn->connect_error);
     }
        
     // sentencia preparada para actualizar estudiante
     $stmt = $conn->prepare("UPDATE estudiantes set dni=?,nombre=?,apellidos=?,edad=?,imagen=ifnull(?,imagen) WHERE dni=?");
     $stmt->bind_param("sssiss", $dni, $nombre, $apellidos, $edad, $imgContent,$dni_modificar);
    
     // dar valores a los parámetros de la sentencia preparada
     $dni =  $_POST['dni'];
     $dni_modificar =  $_POST['dni_modificar'];
     $nombre = $_POST['nombre'];
     $apellidos =  $_POST['apellidos'];
     $edad = $_POST['edad'];
        
     if(!empty($_FILES['imagen']['tmp_name'])) 
     {
          $imgContent= file_get_contents($_FILES['imagen']['tmp_name']);
     }
     
     // ejecutar sentencia preparada
     $rc=$stmt->execute();
     
     if ($rc === false) 
     {
          $mensaje= "Error: " . $stmt->error;
     }
     else
     {
           $mensaje= "Estudiante (".$dni_modificar.") modificado a (".$dni.",".$nombre.",".$apellidos.",".$edad.")";   
     }
     
     // cerrar sentencia preparada y conexión  
     $stmt->close();    
     $conn->close();  
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
        <title>Tabla de estudiantes</title>
</head>
<body>

<h1>Tabla de estudiantes</h1>

<nav> <a href="estudiante.php">Ver estudiantes</a> </nav>

<p>Formulario de edición de estudiantes:</p>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

  <img src="ver-imagen-estudiante.php?dni=<?= $dni ?>" width="100" height="100"/><br>
 
  <label for="dni">Dni:</label><br>
  <input type="text" id="dni" name="dni" value="<?= $dni ?>"><br>  
  <input type='hidden' name='dni_modificar' value="<?= $dni ?>">
  
  <label for="nombre">Nombre:</label><br>
  <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>"><br>
  
  <label for="apellidos">Apellidos:</label><br>
  <input type="text" id="apellidos" name="apellidos" value="<?= $apellidos ?>"><br>
  
  <label for="edad">Edad:</label><br>
  <input type="text" id="edad" name="edad" value="<?= $edad ?>"><br>
  
  <label for="imagen">Imagen:</label><br>
  <input type="file" name="imagen"/><br><br>
  
  <input type="submit" value="Submit">
  
</form> 

<p><?= $mensaje?></p>

</body>
</html>
