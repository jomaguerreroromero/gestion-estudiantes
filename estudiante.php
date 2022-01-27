<?php
$servername = "fdb27.runhosting.com";
$username = "3806697_pruebas";
$password = "Az#12345678#";
$dbname = "3806697_pruebas";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if($_SERVER['REQUEST_METHOD']=="POST")
{
        $dni= $_POST['dni'];
        $sql = "DELETE FROM estudiantes WHERE dni='$dni'";
        $result = $conn->query($sql);
        if (!$result) 
        {
                $mensaje= "Ha fallado el borrado<br><br>";
        }
}

$estudiantes=array();

$sql = "SELECT dni, nombre, apellidos, edad FROM estudiantes";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  while($row = $result->fetch_assoc()) 
  {
          $estudiantes[]=$row;
  }   
} 
else 
{
  $mensaje= "0 results";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
        <title>Tabla de estudiantes</title>
        <style>table, th, td {border: 1px solid black;}</style>
</head>
<body>

<h1>Tabla de estudiantes</h1>

<nav> <a href="insertar-estudiante.php">Insertar estudiantes</a> </nav>

<p>Nuestra base de datos tiene la siguiente información:</p>

<table>
        <tr>
                <th>avatar</th>
                <th>dni</th>
                <th>nombre</th>
                <th>apellidos</th>
                <th>edad</th>
                <th colspan='2'>acciones</th>
        </tr>
        <?php foreach ($estudiantes as $estudiante) : ?>
        <tr>
                <td><img src="ver-imagen-estudiante.php?dni=<?= $estudiante['dni'] ?>"width="100" height="100"/></td>
                <td><?=$estudiante['dni'] ?></td>
                <td><?=$estudiante['nombre'] ?></td>
                <td><?=$estudiante['apellidos'] ?></td>
                <td><?=$estudiante['edad'] ?></td>
                <td>
                    <form action='modificar-estudiante.php' method='get'>
                            <input type='hidden' name='dni' value="<?=$estudiante['dni'] ?>">
                            <input type='hidden' name='nombre' value="<?=$estudiante['nombre'] ?>">
                            <input type='hidden' name='apellidos' value="<?=$estudiante['apellidos'] ?>">
                            <input type='hidden' name='edad' value="<?=$estudiante['edad'] ?>">
                            <input type='submit' value='Editar'>
                    </form>
                </td>
                <td>
                    <form action='estudiante.php' method='post'>
                            <input type='hidden' name='dni' value="<?=$estudiante['dni'] ?>">
                            <input type='submit' value='Borrar'>
                    </form>
                </td>               
        </tr>
        <?php endforeach; ?>
        
</table>

<p><?= $mensaje ?></p>

</body>
</html>
