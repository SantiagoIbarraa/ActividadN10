<?php

// Incluimos la conexión a la base de datos
include 'api/db_connect.php';

// --- DATOS DEL ADMINISTRADOR QUE QUIERES CREAR ---
$nombre_usuario = 'admin';
$email = 'admin@correo.com';
$contrasena_plana = 'PasswordAdmin123!'; // Elige una contraseña segura
$rol = 'root';
// ------------------------------------------------

echo "<h1>Creando usuario administrador...</h1>";

// Hashear la contraseña para máxima seguridad
$contrasena_hasheada = password_hash($contrasena_plana, PASSWORD_DEFAULT);

// Verificar si el usuario ya existe
$stmt_check = $conn->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? OR email = ?");
$stmt_check->bind_param("ss", $nombre_usuario, $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "<p style='color: orange;'><strong>AVISO:</strong> El usuario '$nombre_usuario' o el email '$email' ya existen en la base de datos. No se realizaron cambios.</p>";
} else {
    // Preparar la consulta para insertar el nuevo usuario administrador
    $stmt_insert = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email, contrasena, rol) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("ssss", $nombre_usuario, $email, $contrasena_hasheada, $rol);

    // Ejecutar y verificar
    if ($stmt_insert->execute()) {
        echo "<p style='color: green;'><strong>¡ÉXITO!</strong> Se ha creado el usuario administrador con los siguientes datos:</p>";
        echo "<ul>";
        echo "<li><strong>Usuario:</strong> " . htmlspecialchars($nombre_usuario) . "</li>";
        echo "<li><strong>Contraseña:</strong> " . htmlspecialchars($contrasena_plana) . "</li>";
        echo "<li><strong>Rol:</strong> " . htmlspecialchars($rol) . "</li>";
        echo "</ul>";
        echo "<p style='color: red; font-weight: bold;'>¡MUY IMPORTANTE! Por favor, borra este archivo (crear_admin.php) de tu servidor ahora mismo.</p>";
    } else {
        echo "<p style='color: red;'><strong>ERROR:</strong> No se pudo crear el usuario. Error: " . $stmt_insert->error . "</p>";
    }
    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();

?>