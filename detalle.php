<?php
// Verificar si el parámetro 'id' existe en la URL (GET)
// Si no se pasa un ID, redirigir al listado de productos
if(!isset($_GET['id'])){
    header('location:listado.php'); // Redirige a listado.php si no se pasa el ID
    
}

// Recoger el ID del producto que se pasa por la URL
$id = $_GET['id'];

// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

// Consulta SQL para obtener el producto por su ID
$consulta1 = "SELECT * FROM productos WHERE id = :i";
$stmt1 = $conProyecto->prepare($consulta1); // Preparar la consulta para evitar inyecciones SQL

try {
    // Ejecutar la consulta pasando el ID como parámetro
    $stmt1->execute([':i' => $id]);
} catch(PDOException $ex) {
    // Si ocurre un error durante la ejecución, mostrar mensaje de error y terminar el script
    die("Error al recuperar los productos: " . $ex->getMessage());
}

// Obtener los datos del producto en formato de objeto
$producto = $stmt1->fetch(PDO::FETCH_OBJ);

// Si no se encuentra el producto, redirigir a listado.php para evitar modificación manual de URL
if(!$producto) {
    header('location:listado.php'); // Si no se encuentra el producto con el ID, redirige a listado.php
    
}

// Liberar los recursos de la consulta y la conexión
$stmt1 = null;
$conProyecto = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusión de la hoja de estilos Bootstrap desde CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    
    <title>Detalle Producto</title>
</head>
<body style="background:#4dd0e1">

    <!-- Título principal de la página -->
    <h3 class="text-center mt-2 font-weight-bold">Detalle del Producto</h3>

<?php
// Usamos la sintaxis heredoc para crear el contenido HTML que se va a mostrar
echo <<<MARCA
<div class="container mt-3">
    <!-- Tarjeta que contiene los detalles del producto -->
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width:58rem;">
        <div class="card-header text-center text-weight-bold"> $producto->nombre</div>
        <div class="card-body" style="font-size:1.1em">
            <!-- Mostrar el código del producto -->
            <h5 class="card-title text-center">Código: $producto->id</h5>
            <!-- Mostrar el nombre del producto -->
            <p class="card-text"><b>Nombre:</b> $producto->nombre</p>
            <!-- Mostrar el nombre corto del producto -->
            <p class="card-text"><b>Nombre Corto:</b> $producto->nombre_corto</p>
            <!-- Mostrar el código de la familia del producto -->
            <p class="card-text"><b>Código Familia:</b> $producto->familia</p>
            <!-- Mostrar el precio del producto -->
            <p class="card-text"><b>Precio (€):</b> $producto->pvp</p>
            <!-- Mostrar la descripción del producto -->
            <p class="card-text"><b>Descripción:</b> $producto->descripcion</p>
        </div>
    </div>

    <!-- Botón para volver al listado de productos -->
    <div class="container mt-5 text-center">
        <a href="listado.php" class="btn btn-info">Volver</a>
    </div>
</div>
MARCA;
?>
</body>
</html>
