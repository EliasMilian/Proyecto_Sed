<?php
// login_post.php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/conn/connection.php';

// Leer datos del formulario
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($username === '' || $password === '') {
    header('Location: index.php?err=1'); // Campos vacíos
    exit;
}

try {
    // Consulta sencilla con sentencia preparada
    $stmt = $conn->prepare(
        "SELECT id, username, password, nombre, rol
         FROM users
         WHERE username = :username
         LIMIT 1"
    );
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    // En tu BD las contraseñas están en texto plano (admin123, profe123, etc.)
    if (!$user || $user['password'] !== $password) {
        header('Location: index.php?err=1'); // Credenciales incorrectas
        exit;
    }

    // Login correcto — variables que tu app ya usa
    $_SESSION['username'] = $user['username'];
    $_SESSION['nombre']   = $user['nombre'];
    $_SESSION['rol']      = $user['rol'];

    // Algunas vistas usan estas:
    $_SESSION['usuario'] = $user['username'];
    $_SESSION['role']    = $user['rol'];

    // Cookie simple de actividad
    setcookie('activo', 1, time() + 3600, '/', '', false, true);

    header('Location: inicio.view.php');
    exit;

} catch (PDOException $e) {
    error_log("Login PDO ERROR: " . $e->getMessage());
    echo "Error interno al procesar el login.";
    exit;
}
