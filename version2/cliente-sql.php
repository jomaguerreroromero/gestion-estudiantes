<?php
$servername = "fdb27.runhosting.com";
$username = "3806697_pruebas";
$password = "Az#12345678#";
$dbname = "3806697_pruebas";

/*****************************************************************************************/
/***Función que realiza una consulta sql y devuelve las filas del resultado en un array***/
/*****************************************************************************************/
function consulta_sql($consulta)
{
   global $servername;
   global $username;
   global $password;
   global $dbname;

   // Crear conexión
   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) 
   {
     die("Connection failed: " . $conn->connect_error);
   }
   
   // Ejecutar consulta
   $resultado=$conn->query($consulta);
   
   // Guardar resultado en array $filas
   $filas=array();
   
   if ($resultado->num_rows > 0) 
   {
    while($fila = $resultado->fetch_assoc()) 
    {
          $filas[]=$fila;
    }   
   } 
   
   // Cerrar conexión    
   $conn->close();
   
   return $filas;
}

/**************************************************************************************************************/
/***Función que ejecuta un comando sql y devuelve true/false dependiendo de si la operación ha tenido éxito ***/
/**************************************************************************************************************/
function comando_sql($comando,$tipos,$array_valores)
{
   global $servername;
   global $username;
   global $password;
   global $dbname;
   
   // Crear conexión
   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) 
   {
     die("Connection failed: " . $conn->connect_error);
   }

     
   // Sentencia preparada
   $stmt = $conn->prepare($comando);     
   $stmt->bind_param($tipos, ...$array_valores);
    
     
   // Ejecutar sentencia preparada
   $resultado=$stmt->execute();
     
     
   // Cerrar sentencia preparada y conexión  
   $stmt->close();    
   $conn->close();
   
   return $resultado;
}

?>
