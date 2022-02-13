<!DOCTYPE html>
<html lang="es">
<head>
        <title>Tabla de localidades</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <nav class="navbar navbar-expand-sm bg-light fixed-top">
          <div class="container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="estudiante.php">Estudiantes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="localidad.php">Localidades</a>
              </li>
            </ul>
          </div>
        </nav>
        
        <div class="container-fluid" style="margin-top:80px">
                
                <h1>Localidades</h1>
                
                <button onclick="resetear()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Nuevo</button>         
                
                <table class="table ">
                        <tr>
                                <th>codigo postal</th>
                                <th>nombre</th>
                                <th colspan='2'>acciones</th>
                        </tr>
                        <?php foreach ($localidades as $localidad) : ?>
                        <tr id="<?=$localidad['codigopostal'] ?>">
                                <td><?=$localidad['codigopostal'] ?></td>
                                <td><?=$localidad['nombre'] ?></td>
                                <td><button onclick="editar(this)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Editar</button></td>
                                <td>
                                        <form action='localidad.php' method='post'>
                                                <input type='hidden' name='codigopostal' value="<?=$localidad['codigopostal'] ?>">
                                                <button type='submit' class="btn btn-danger" name="borrar">Borrar</button>
                                        </form>                 
                                </td>               
                        </tr>
                        <?php endforeach; ?>
                </table> 
                
                <p><?= $mensaje ?></p>

                <!-- Formulario modal -->
                <div class="modal" id="myModal">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                        
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                                <h4 class="modal-title">Modal Heading</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                                <form id="formulario" action=localidad.php method="post" enctype="multipart/form-data"> 
                                                        <br><label for="codigopostal">Codigo postal:</label><br>
                                                        <input type="text" id="codigopostal" name="codigopostal"><br> 
  
                                                        <input type="hidden" id="codigopostal_modificar" name="codigopostal_modificar">
  
                                                        <label for="nombre">Nombre:</label><br>
                                                        <input type="text" id="nombre" name="nombre"><br> 
  
                                                        <input type="submit" id="aceptar" name="aceptar" value="Aceptar">  
                                                </form> 
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        
        <script>
        function editar(elemento) 
        {
                resetear();
                
                /*** copiar datos del estudiante en el formulario ***/
                var tds = document.getElementById(elemento.parentNode.parentNode.id).getElementsByTagName("td");
                document.getElementById('codigopostal').value=tds[0].innerText;
                document.getElementById('codigopostal_modificar').value=tds[0].innerText;
                document.getElementById('nombre').value=tds[1].innerText;               
        }

        function resetear() 
        {
                /*** resetear formulario ***/
                var formulario = document.getElementById('formulario'); 
                formulario.reset();
        }
        </script>
</body>
</html>
