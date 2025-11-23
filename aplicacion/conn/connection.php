<?php
// conn/connection.php
// Conexión usando root (XAMPP) sin contraseña

$DB_HOST = 'localhost';
$DB_NAME = 'centroescolarbd';

$DB_USER = 'root';
$DB_PASS = '';

try {
    $conn = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("ERROR DE CONEXIÓN: " . $e->getMessage());
}
?>
