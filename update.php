<?php
// Verificar si el parámetro 'id' está presente en la URL (usado para identificar el producto a modificar)
if(!isset($_GET['id'])){
    // Si no existe 'id', redirigir al listado de productos
    header('location:listado.php');
    exit();
}

// Obtener el 'id' del producto desde la URL
$id = $_GET['id'];

// Incluir la conexión a la base de datos
require_once 'conexion.php';

// Consultar el producto en la base de datos usando el ID proporcionado
$consulta1 = "SELECT * FROM productos WHERE id = :i";
$stmt1 = $conProyecto->prepare($consulta1);

try {
    // Ejecutar la consulta con el parámetro del ID
    $stmt1->execute([':i' => $id]);
} catch (PDOException $ex) {
    // Si ocurre un error en la consulta, mostrar el mensaje de error
    die("Error al recuperar el producto: " . $ex->getMessage());
}

// Obtener el resultado de la consulta (producto) en formato de objeto
$producto = $stmt1->fetch(PDO::FETCH_OBJ);

// Si no se encuentra el producto, redirigir al listado de productos
if (!$producto) {
    header('location:listado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir el CSS de Bootstrap para estilizar la página -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <title>Modificar Producto</title>
</head>
<body style="background:#4dd0e1">

    <!-- Título principal -->
    <h3 class="text-center mt-2 font-weight-bold">Modificar producto</h3>

    <div class="container mt-3">

<?php
// Verificar si el formulario ha sido enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    // Si el formulario fue enviado, incluir el archivo que guarda los datos modificados
    include "update_guardardatos.php";
} else {
    // Si no se enviaron datos (es decir, es el primer acceso o una carga de la página),
    // incluir el formulario para mostrar los datos actuales del producto y permitir su modificación
    include "crear_formularioalta.php";  // Este archivo debe ser adecuado para la modificación de productos
}
?>

    </div>
</body>
</html>


