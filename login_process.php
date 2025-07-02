<?php
session_start(); // Iniciamos la sesión
include 'api/db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Buscar usuario por nombre de usuario o email
$stmt = $conn->prepare("SELECT id, nombre_usuario, contrasena, rol FROM usuarios WHERE nombre_usuario = ? OR email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Verificar la contraseña hasheada
    if (password_verify($password, $user['contrasena'])) {
        // Contraseña correcta: guardar datos en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
        $_SESSION['rol'] = $user['rol'];
        
        // Redirigir según el rol
        if ($user['rol'] === 'root') {
            header("Location: panel_admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
    }
}

// Si algo falla, redirigir de vuelta al login con un error
header("Location: login.php?error=1");
exit();

$stmt->close();
$conn->close();
?>