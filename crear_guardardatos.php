<?php
// Definición de la función 'comprobar' para verificar que los campos no estén vacíos
function comprobar($n, $nc){
    // Si la longitud de los campos 'nombre' o 'nombre corto' es 0 (vacíos), muestra un mensaje de error
    if (strlen($n) == 0 || strlen($nc) == 0) {
        echo "<b>Algunos campos del formulario no pueden estar en blanco, revíselos.</b>";
        // Muestra un enlace para que el usuario vuelva a la página de creación de productos
        echo "<a href='crear-php' style='text-decoration:none;'><button>Volver</button></a>";
    }
}

// Recoger los datos del formulario, eliminando espacios en blanco al principio y al final
$nombre = trim($_POST['nombre']);    // Nombre del producto
$nomCorto = trim($_POST['nombrec']); // Nombre corto del producto
$pvp = $_POST['pvp'];               // Precio del producto
$des = trim($_POST['descripcion']);  // Descripción del producto
$familia = $_POST['familia'];       // Familia del producto

// Llamar a la función para comprobar si los campos 'nombre' y 'nombre corto' están vacíos
comprobar($nombre, $nomCorto);

// Convertir el nombre corto a mayúsculas para uniformidad en la base de datos
$nomCorto = strtoupper($nomCorto);

// Convertir la primera letra de cada palabra del nombre del producto a mayúscula
$nombre = ucwords($nombre);

// Preparar la consulta SQL para insertar el producto en la base de datos
$insert = "INSERT INTO productos(nombre, nombre_corto, pvp, familia, descripcion) 
           VALUES(:n, :nc, :p, :f, :d)";
$stmt1 = $conProyecto->prepare($insert);

try {
    // Ejecutar la consulta preparada, insertando los valores del formulario
    $stmt1->execute([
        ':n' => $nombre,     // Bind del nombre completo
        ':nc' => $nomCorto,  // Bind del nombre corto
        ':p' => $pvp,        // Bind del precio
        ':f' => $familia,    // Bind de la familia
        ':d' => $des         // Bind de la descripción
    ]);
} catch (PDOException $ex) {
    // Si ocurre un error durante la ejecución de la consulta, muestra un mensaje de error
    die("Ocurrió un error al insertar el producto. Mensaje de error: " . $ex->getMessage());
}

// Liberar recursos y cerrar la conexión
$stmt1 = null;
$conProyecto = null;

// Mostrar mensaje de éxito y un enlace para volver al listado de productos
echo "<p class='text-info font-weight-bold'>Producto guardado con éxito<a href='listado.php' class='btn btn-info'>Volver</a></p>";

?>
