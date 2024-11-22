<form name="crear" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"> <!-- El formulario se enviará al mismo archivo PHP -->

    <!-- Fila para los campos de nombre y nombre corto -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <!-- Campo para el nombre del producto -->
            <label for="n">Nombre </label>
            <input type="text" class="form-control" id="n" value='<?php echo $producto->nombre?>' name="nombre" required> <!-- Rellena con el nombre actual del producto -->
        </div>
        <div class="form-group col-md-6">
            <!-- Campo para el nombre corto del producto -->
            <label for="nc">Nombre Corto</label>
            <input type="text" class="form-control" id="nc" value='<?php echo $producto->nombre_corto?>' name="nombrec" required> <!-- Rellena con el nombre corto actual del producto -->
        </div>
    </div>

    <!-- Fila para los campos de precio y familia -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <!-- Campo para el precio del producto -->
            <label for="p">Precio(€) </label>
            <input type="number" class="form-control" id="p" value='<?php echo $producto->pvp?>' name="pvp" min="0" step="0.01" required> <!-- Rellena con el precio actual del producto -->
        </div>
        <div class="form-group col-md-6">
            <!-- Campo para seleccionar la familia del producto -->
            <label for="f">Familia</label>
            <select class="form-control" name="familia">
                <?php
                // Consulta SQL para obtener las familias de productos
                $consulta = "SELECT cod, nombre FROM familias ORDER BY nombre";
                $stmt = $conProyecto->prepare($consulta);  // Preparar la consulta

                try {
                    $stmt->execute();  // Ejecutar la consulta
                } catch(PDOException $ex) {
                    die("Error al recuperar las familias: " . $ex->getMessage());  // Manejo de errores en caso de fallo en la consulta
                }

                // Recorrer los resultados de las familias y mostrarlas en el desplegable
                while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                    // Si la familia actual es la misma que la del producto, marcarla como seleccionada
                    if ($filas->cod == $producto->familia) {
                        echo "<option value='{$filas->cod}' selected> $filas->nombre</option>";
                    } else {
                        // Si no es la familia seleccionada, mostrarla normalmente
                        echo "<option value='{$filas->cod}'>$filas->nombre</option>";
                    }
                }
                $stmt = null;  // Liberar la consulta
                $conProyecto = null;  // Cerrar la conexión a la base de datos
                ?>
            </select>
        </div>
    </div>

    <!-- Fila para el campo de descripción -->
    <div class="form-row">
        <div class="form-group col-md-9">
            <!-- Campo de texto largo para la descripción del producto -->
            <label for="d">Descripción </label>
            <textarea class="form-control" id="d" name="descripcion" rows="12"><?php echo $producto->descripcion;?></textarea> <!-- Rellena con la descripción actual del producto -->
        </div>
    </div>

    <!-- Botón de envío del formulario -->
    <button type="submit" class="btn btn-primary mr3" name="enviar">Modificar</button>
    
    <!-- Enlace para volver al listado de productos -->
    <a href="listado.php" class="btn btn-info">Volver</a>
</form>
