<form name="crear" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <!-- Fila para el nombre y nombre corto del producto -->
    <div class="form-row">
        <!-- Campo de nombre del producto -->
        <div class="form-group col-md-6">
            <label for="n">Nombre </label>
            <input type="text" class="form-control" id="n" placeholder="Nombre" name="nombre" required>
        </div>
        <!-- Campo de nombre corto del producto -->
        <div class="form-group col-md-6">
            <label for="nc">Nombre Corto</label>
            <input type="text" class="form-control" id="nc" placeholder="Nombre Corto" name="nombrec" required>
        </div>
    </div>

    <!-- Fila para el precio y la familia del producto -->
    <div class="form-row">
        <!-- Campo de precio del producto -->
        <div class="form-group col-md-6">
            <label for="p">Precio(€) </label>
            <input type="number" class="form-control" id="p" placeholder="Precio (€)" name="pvp" min="0" step="0.01" required>
        </div>
        <!-- Campo de selección para la familia del producto -->
        <div class="form-group col-md-6">
            <label for="f">Familia</label>
            <select class="form-control" name="familia" required>
                <!-- PHP para cargar las opciones de familias desde la base de datos -->
                <?php
                    // Consulta SQL para obtener las familias ordenadas por nombre
                    $consulta = "SELECT cod, nombre FROM familias ORDER BY nombre";
                    $stmt = $conProyecto->prepare($consulta);

                    try {
                        // Ejecutar la consulta
                        $stmt->execute();
                    } catch (PDOException $ex) {
                        // Si ocurre un error al ejecutar la consulta
                        die("Error al recuperar las familias: " . $ex->getMessage());
                    }

                    // Bucle para mostrar todas las familias disponibles
                    while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                        // Crear una opción en el select para cada familia
                        echo "<option value='{$filas->cod}'>$filas->nombre</option>";
                    }
                    // Liberar recursos y cerrar la conexión
                    $stmt = null;
                    $conProyecto = null;
                ?>
            </select>
        </div>
    </div>

    <!-- Fila para la descripción del producto -->
    <div class="form-row">
        <!-- Campo de texto para la descripción del producto -->
        <div class="form-group col-md-9">
            <label for="d">Descripción </label>
            <textarea class="form-control" id="d" name="descripcion" rows="12"></textarea>
        </div>
    </div>

    <!-- Botones para enviar, limpiar o volver -->
    <button type="submit" class="btn btn-primary mr-3" name="enviar">Crear</button>
    <!-- Botón para limpiar el formulario -->
    <input type="reset" value="Limpiar" class="btn btn-success mr-3">
    <!-- Botón para volver al listado de productos -->
    <a href="listado.php" class="btn btn-info">Volver</a>
</form>
