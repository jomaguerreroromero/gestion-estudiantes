<?php

require('cliente-sql.php');

/*** leer valores enviados mediante el formulario ***/
$codigopostal=$_POST['codigopostal'];
$codigopostal_modificar=$_POST['codigopostal_modificar'];
$nombre=$_POST['nombre'];

/*** insertar nueva localidad ***/
if (isset($_POST['aceptar']) && $_POST['codigopostal_modificar']==null)
{     
     if(comando_sql("INSERT INTO localidades (codigopostal,nombre) VALUES (?, ?)","ss",array($codigopostal, $nombre)))
     {
          $mensaje= "Localidad (".$codigopostal.",".$nombre.") creada satisfactoriamente";         
     }
     else
     {
          $mensaje= "Error. No se ha podido insertar la localidad";
     }
} 

/*** actualizar localidad ***/
elseif (isset($_POST['aceptar']))
{        
     if(comando_sql("UPDATE localidades set codigopostal=?,nombre=? WHERE codigopostal=?","sss",array($codigopostal, $nombre, $codigopostal_modificar)))
     {
          $mensaje= "Localidad (".$codigopostal_modificar.") modificada satisfactoriamente a (".$codigopostal.",".$nombre.")";         
     }
     else
     {
          $mensaje= "Error. No se ha podido modificar la localidad";
     }
}

/*** borrar localidad ***/
elseif (isset($_POST['borrar']))
{        
     if(comando_sql("DELETE FROM localidades WHERE codigopostal=?","s",array($codigopostal)))
     {
           $mensaje= "Localidad (".$codigopostal.") borrada satisfactoriamente";         
     }
     else
     {
          $mensaje= "Error. No se ha podido borrar la localidad";
     }       
}   
   
/*** Guardar en el array $localidades todos los datos de la consulta ***/
$sql = "SELECT codigopostal, nombre FROM localidades";
$localidades=consulta_sql($sql);


/*** insertar la vista ***/
require('localidad.vista.php');

?>
