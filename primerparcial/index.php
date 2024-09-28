<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Búsqueda del Usuario en la BBDD
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificación de la Contraseña
        if (password_verify($input_password, $user['password'])) {
            // Si la autenticación fue exitosa -->
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center">Iniciar Sesión</h3>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
                <div class="mt-3 text-center">
                    <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>