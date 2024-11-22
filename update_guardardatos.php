<?php
// Función para comprobar que los campos no estén vacíos
function comprobar($n, $nc){
    // Si el nombre o nombre corto están vacíos, mostrar un mensaje de error
    if(strlen($n) == 0 || strlen($nc) == 0){
        echo"<b>Algunos campos del formulario, no pueden estar en blanco, reviselos</b>";
        // Proporcionar un enlace para volver al formulario de creación
        echo"<a href='crear-php' style='text-decoration:none;'><button>Volver</button></a>";
    }
}

// Recoger datos del formulario y eliminar espacios en blanco antes y después de los valores
$nombre = trim($_POST['nombre']); // Eliminar espacios al inicio y al final del nombre
$nomCorto = trim($_POST['nombrec']); // Eliminar espacios al inicio y al final del nombre corto
$pvp = $_POST['pvp']; // Obtener el precio del producto
$des = trim($_POST['descripcion']); // Eliminar espacios al inicio y al final de la descripción
$familia = $_POST['familia']; // Obtener el código de la familia del producto

// Llamar a la función para comprobar que los campos no estén vacíos
comprobar($nombre, $nomCorto);

// Convertir el nombre corto a mayúsculas
$nomCorto = strtoupper($nomCorto);

// Convertir el nombre a formato capitalizado (primeras letras en mayúsculas)
$nombre = ucwords($nombre);

// Consulta SQL para actualizar los datos del producto
$update = "UPDATE productos SET nombre=:n, nombre_corto=:nc, pvp=:p, descripcion=:d, familia=:f WHERE id=:i";
$stmt2 = $conProyecto->prepare($update); // Preparar la consulta

try {
    // Ejecutar la consulta con los valores obtenidos del formulario
    $stmt2->execute([
        ':n' => $nombre,  // Pasar el nombre
        ':nc' => $nomCorto,  // Pasar el nombre corto
        ':p' => $pvp,  // Pasar el precio
        ':f' => $familia,  // Pasar el código de la familia
        ':d' => $des,  // Pasar la descripción
        ':i' => $id  // Pasar el ID del producto que se va a actualizar
    ]);
} catch (PDOException $ex) {
    // Manejar cualquier error que ocurra durante la ejecución de la consulta
    die("Ocurrió un error al actualizar el producto, mensaje de error: " . $ex->getMessage());
}

// Liberar recursos y cerrar la conexión
$stmt2 = null;
$conProyecto = null;

// Mensaje indicando que el producto fue actualizado correctamente
echo "<p class='text-info font-weight-bold'>Producto actualizado con éxito<a href='listado.php' class='btn btn-info'>Volver</a></p>";
?>
