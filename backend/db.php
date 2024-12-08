<?php
$host = "localhost";
$dbname = "sorteo";
$username = "root"; // Usuario predeterminado de XAMPP
$password = ""; // Sin contraseña por defecto

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
