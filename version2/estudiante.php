<?php

require('cliente-sql.php');


if (isset($_POST['aceptar']) && $_POST['dni_modificar']==null)
{
     $dni=$_POST['dni'];
     $nombre=$_POST['nombre'];
     $apellidos=$_POST['apellidos'];
     $edad=$_POST['edad'];
     
     if(!empty($_FILES['imagen']['tmp_name'])) 
     {
          $imgContent= file_get_contents($_FILES['imagen']['tmp_name']);
     }
        
     $sql = "INSERT INTO estudiantes (dni,nombre,apellidos,edad,imagen) VALUES (?, ?, ?, ?, ?)";
     $tipos="sssis";
     $valores=array($dni, $nombre, $apellidos, $edad, $imgContent);
     
     if(comando_sql($sql,$tipos,$valores))
     {
          $mensaje= "Estudiante (".$dni.",".$nombre.",".$apellidos.",".$edad.") creado satisfactoriamente";         
     }
     else
     {
          $mensaje= "Error. No se ha podido insertar el estudiante";
     }
} 
   
elseif (isset($_POST['aceptar']))
{
     $dni=$_POST['dni'];
     $dni_modificar=$_POST['dni_modificar'];
     $nombre=$_POST['nombre'];
     $apellidos=$_POST['apellidos'];
     $edad=$_POST['edad'];
     
     if(!empty($_FILES['imagen']['tmp_name'])) 
     {
          $imgContent= file_get_contents($_FILES['imagen']['tmp_name']);
     }
        
     $sql = "UPDATE estudiantes set dni=?,nombre=?,apellidos=?,edad=?,imagen=ifnull(?,imagen) WHERE dni=?";
     $tipos="sssiss";
     $valores=array($dni, $nombre, $apellidos, $edad, $imgContent,$dni_modificar);
     
     if(comando_sql($sql,$tipos,$valores))
     {
          $mensaje= "Estudiante (".$dni_modificar.") modificado satisfactoriamente a (".$dni.",".$nombre.",".$apellidos.",".$edad.")";         
     }
     else
     {
          $mensaje= "Error. No se ha podido modificar el estudiante";
     }
}

elseif (isset($_POST['borrar']))
{
     $dni= $_POST['dni'];
     
     $sql = "DELETE FROM estudiantes WHERE dni=?";
     $tipos="s";
     $valores=array($dni);
        
     if(comando_sql($sql,$tipos,$valores))
     {
           $mensaje= "Estudiante (".$dni.") borrado satisfactoriamente";         
     }
     else
     {
          $mensaje= "Error. No se ha podido borrar el estudiante";
     }       
}   
   
/*** Guardar en el array $estudiantes todos los datos de la tabla estudiantes ***/
$sql = "SELECT dni, nombre, apellidos, edad, imagen FROM estudiantes";
$estudiantes=consulta_sql($sql);

/*** Guardar en la variable $imagePng una imagen con el texto 'Sin imagen' ***/
$blank_image = imagecreate(100, 100);  
$background_color = imagecolorallocate($blank_image, 0, 153, 0);  
$text_color = imagecolorallocate($blank_image, 255, 255, 255); 
imagestring($blank_image, 5, 5, 40,  "Sin imagen", $text_color);
ob_start();
imagepng($blank_image);
$imagePng = ob_get_clean();

/*** insertar la vista ***/
require('estudiante.vista.php');

?>

