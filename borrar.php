<?php
// Verificar si no se ha enviado el código del producto a borrar
if(!isset($_POST['id'])){
    // Si no se recibe el 'id' del producto, redirigir al listado de productos
    // Esto previene el acceso a esta página sin un 'id' válido
    header('location:listado.php');
  
}

// Obtener el 'id' del producto desde el formulario POST
$cod = $_POST['id'];

// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

// Preparar la consulta SQL para eliminar el producto con el ID especificado
$delete = "DELETE FROM productos WHERE id = :i";
$stmt = $conProyecto->prepare($delete);

try {
    // Ejecutar la consulta preparada con el 'id' del producto
    $stmt->execute([':i' => $cod]);
} catch(PDOException $ex) {
    // Si ocurre un error durante la ejecución de la consulta, se captura la excepción
    // Se liberan los recursos y se muestra el mensaje de error
    $stmt = null;
    $conProyecto = null;
    echo "Ocurrió un error al borrar el producto. Mensaje: " . $ex->getMessage();
    // Proporcionar un botón para volver al listado de productos
    echo "<a href='listado.php' style='text-decoration:none;'><button>Volver</button></a>";
    exit();
}

// Liberar los recursos de la consulta y de la conexión
$stmt = null;
$conProyecto = null;

// Mostrar un mensaje de éxito después de borrar el producto
echo "<p style='font-weight:bold'>Producto de Código: $cod, borrado correctamente.</p>";

// Proporcionar un botón para volver al listado de productos
echo "<a href='listado.php' style='text-decoration:none;'><button>Volver</button></a>";
?>
