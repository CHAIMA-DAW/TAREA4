<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous"> <!--CSS para usar Bootstrap-->
    
    <title>LISTADO</title>
</head>
<body style="background:#4dd0e1">
    <!-- Título principal -->
    <h3 class="text-center mt-2 font-weight-bold">Gestión de productos</h3>
    <div class="container mt-3">
        <!-- Enlace para crear un nuevo producto -->
        <a href="crear.php" class="btn btn-success mt-2 mb-2">Crear</a>
        
        <!-- Tabla para listar productos -->
        <table class="table table-striped table-dark">
            <thead>
                <tr class="text-center">
                    <th scope="col">Detalle</th>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php
    // Conexión a la base de datos
    require_once 'conexion.php';

    // Consulta SQL para obtener productos
    $consulta = "SELECT id, nombre FROM productos ORDER BY nombre";
    $stmt = $conProyecto->prepare($consulta);

    try {
        // Ejecutar la consulta
        $stmt->execute();
    } catch (PDOException $ex) {
        // Manejo de errores en la consulta
        die("Error al recuperar productos: " . $ex->getMessage());
    }

    // Iterar sobre los resultados de la consulta y generar filas de la tabla
    while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo <<<MARCA
        <tr class='text-center'>
            <!-- Botón para ver detalles del producto -->
            <th scope='row'><a href='detalle.php?id={$filas->id}' class='btn btn-info'>Detalle</a></th>
            
            <!-- Mostrar ID del producto -->
            <td>{$filas->id}</td>
            
            <!-- Mostrar nombre del producto -->
            <td>{$filas->nombre}</td>
            
            <td>
                <!-- Formulario para eliminar el producto -->
                <form name='a' action='borrar.php' method='POST' style='display:inline'>
                    <!-- Botón para actualizar el producto -->
                    <a href='update.php?id={$filas->id}' class='btn btn-warning mr-2'>Actualizar</a>
                    
                    <!-- Campo oculto con el ID del producto para eliminar -->
                    <input type='hidden' name='id' value='{$filas->id}' />
                    
                    <!-- Botón de borrar con confirmación -->
                    <input type='submit' onclick="return confirm('¿Borrar producto?')" 
                           class='btn btn-danger' value='Borrar' />
                </form>
            </td>
        </tr>
MARCA;
    }

    // Liberar recursos y cerrar la conexión
    $stmt = null;
    $conProyecto = null;
?>
            </tbody>
        </table>
    </div>
</body>
</html>
