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
    <h3 class="text-center mt-2 font-weight-bold">Crear productos</h3>
    <div class="container mt-3">
<?php
require_once 'conexion.php';

if(!isset($POST['enviar'])){//No envian datos:mostrar formulario alta 
    include"crear_formularioalta.php";
}else{ // se han enviado los datos, guardar en base de datos
    include "crear_guardardatos.php";
}
?>
    </div>
</body>
</html>