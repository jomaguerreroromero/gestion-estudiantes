<!DOCTYPE html>
<html lang="es">
<head>
        <title>Tabla de estudiantes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <nav class="navbar navbar-expand-sm bg-light">
          <div class="container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Estudiantes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link 2</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link 3</a>
              </li>
            </ul>
          </div>
        </nav>
        
        <div class="container mt-3">
                
                <h1>Estudiantes</h1>
                
                <button onclick="resetear()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Nuevo</button>         
                
                <table class="table ">
                        <tr>
                                <th>avatar</th>
                                <th>dni</th>
                                <th>nombre</th>
                                <th>apellidos</th>
                                <th>edad</th>
                                <th colspan='2'>acciones</th>
                        </tr>
                        <?php foreach ($estudiantes as $estudiante) : ?>
                        <tr id="<?=$estudiante['dni'] ?>">
                                <td><img src="data:image/png;base64,<?=$estudiante['imagen']?>" width="100" height="100"/></td>
                                <td><?=$estudiante['dni'] ?></td>
                                <td><?=$estudiante['nombre'] ?></td>
                                <td><?=$estudiante['apellidos'] ?></td>
                                <td><?=$estudiante['edad'] ?></td>
                                <td><button onclick="editar(this)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Editar</button></td>
                                <td>
                                        <form action='estudiante.php' method='post'>
                                                <input type='hidden' name='dni' value="<?=$estudiante['dni'] ?>">
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
                                                <form id="formulario" action=estudiante.php method="post" enctype="multipart/form-data"> 
                                                        <br><label for="dni">Dni:</label><br>
                                                        <input type="text" id="dni" name="dni"><br> 
  
                                                        <input type="hidden" id="dni_modificar" name="dni_modificar">
  
                                                        <label for="nombre">Nombre:</label><br>
                                                        <input type="text" id="nombre" name="nombre"><br> 
  
                                                        <label for="apellidos">Apellidos:</label><br>
                                                        <input type="text" id="apellidos" name="apellidos"><br>  
  
                                                        <label for="edad">Edad:</label><br>
                                                        <input type="text" id="edad" name="edad"><br> 
  
                                                        <label for="imagen">Imagen:</label><br>
                                                        <input type="file" id="imagen" name="imagen"/><br><br>  
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
                document.getElementById('dni').value=tds[1].innerText;
                document.getElementById('dni_modificar').value=tds[1].innerText;
                document.getElementById('nombre').value=tds[2].innerText;
                document.getElementById('apellidos').value=tds[3].innerText;
                document.getElementById('edad').value=tds[4].innerText;

                /*** copiar imagen actual del estudiante al principio del formulario ***/
                var clon = tds[0].firstChild.cloneNode(true);
                clon.id='avatar';
                document.getElementById("formulario").prepend(clon);
        }

        function resetear() 
        {
                /*** resetear formulario ***/
                var formulario = document.getElementById('formulario'); 
                formulario.reset();

                /*** borrar en el formulario imagen de avatar ***/
                var avatar = document.getElementById('avatar');
                if (avatar!=null)
                {
                        avatar.remove();
                } 
        }
        </script>
</body>
</html>
