<?php 
$servername = "fdb27.runhosting.com";
$username = "3806697_pruebas";
$password = "Az#12345678#";
$dbname = "3806697_pruebas";

if($_SERVER['REQUEST_METHOD']=="POST")
{
     // crear conexión
     $conn = new mysqli($servername, $username, $password, $dbname);
     
     // comprobar conexión
     if ($conn->connect_error) 
     {
          die("Connection failed: " . $conn->connect_error);
     }
     
     // sentencia preparada para insertar estudiante
     $stmt = $conn->prepare("INSERT INTO estudiantes (dni,nombre,apellidos,edad,imagen) VALUES (?, ?, ?, ?, ?)");
     $stmt->bind_param("sssis", $dni, $nombre, $apellidos, $edad, $imgContent);
    
     // dar valores a los parámetros de la sentencia preparada
     $dni =  $_POST['dni'];
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
          $mensaje= "<p>Error: " . $sql . "<br>" . $stmt->error . "</p>";
     }
     else
     {
           $mensaje= "<p>Estudiante (".$dni.",".$nombre.",".$apellidos.",".$edad.") creado satisfactoriamente</p>";    
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

<nav><a href="estudiante.php">Ver estudiantes</a></nav>

<p>Formulario de creación de estudiantes:</p>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"> 
  <label for="dni">Dni:</label><br>
  <input type="text" id="dni" name="dni"><br>  
  <label for="nombre">Nombre:</label><br>
  <input type="text" id="nombre" name="nombre"><br> 
  <label for="apellidos">Apellidos:</label><br>
  <input type="text" id="apellidos" name="apellidos"><br>  
  <label for="edad">Edad:</label><br>
  <input type="text" id="edad" name="edad"><br> 
  <label for="imagen">Imagen:</label><br>
  <input type="file" name="imagen"/><br><br>  
  <input type="submit" value="Submit">  
</form> 

<p><?= $mensaje ?></p>

</body>
</html>
