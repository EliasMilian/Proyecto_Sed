<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=centroescolarbd;charset=utf8mb4',
        'notasuser',     // <-- PON AQUI el usuario que sabes que te funcionó
        '#YHLQMDLG2025SedContraseniaSegura'          // <-- y su contraseña (puede estar vacía)
    );
    echo "OK CONEXION DIRECTA";
} catch (PDOException $e) {
    echo "ERROR DIRECTO: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
