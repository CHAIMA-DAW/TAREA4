<?php
     $host = "localhost";
     $db   = "proyecto";
     $user = "gestor";
     $pass = "secreto";
     $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
  
 
  try {
 
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit;
  }
?>