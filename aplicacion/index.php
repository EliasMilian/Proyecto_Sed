<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Error messages from query string
$messages = [
    "1" => "Credenciales incorrectas.",
    "2" => "Debe iniciar sesión para acceder al sistema.",
    "3" => "Petición no válida.",
    "4" => "Token de seguridad inválido. Intente de nuevo."
];

$currentError = null;
if (!empty($_GET['err']) && isset($messages[$_GET['err']])) {
    $currentError = $messages[$_GET['err']];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login | Registro de Notas</title>
    <meta name="description" content="Registro de Notas del Centro Universitario Jorge Magico Gonzales" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="login-container">
        <h1>Sistema de Registro de Notas</h1>

        <?php if ($currentError): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($currentError, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="login_post.php" autocomplete="off">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="username" required minlength="3" maxlength="50">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required minlength="4" maxlength="255">
            </div>

            <!-- CSRF protection -->
            <input type="hidden" name="csrf_token"
                   value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

            <div class="form-actions">
                <button type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</body>
</html>
