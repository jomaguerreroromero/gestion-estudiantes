<?php
if(!empty($_GET['dni'])){
    //DB details   
    $dbHost = "fdb27.runhosting.com";
    $dbUsername = "3806697_pruebas";
    $dbPassword = "Az#12345678#";
    $dbName = "3806697_pruebas";
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    
    //Get image data from database
    $result = $db->query("SELECT imagen FROM estudiantes WHERE dni = {$_GET['dni']} and imagen is not null");   
    if($result->num_rows > 0)
    {
        $imgData = $result->fetch_assoc();  
        //Render image
        header("Content-type: image/png"); 
        echo $imgData['imagen']; 
    }
    else
    {      
        // Create the size of image or blank image
        $image = imagecreate(100, 100);  
        // Set the background color of image
        $background_color = imagecolorallocate($image, 0, 153, 0);  
        // Set the text color of image
        $text_color = imagecolorallocate($image, 255, 255, 255); 
        // Function to create image which contains string.
        imagestring($image, 5, 20, 40,  "Avatar", $text_color);
        header("Content-Type: image/png");
        imagepng($image);
        imagedestroy($image);   
    }
}
?>
