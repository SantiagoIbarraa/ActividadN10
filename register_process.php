<?php
// Habilitar el reporte de excepciones de MySQLi para que try...catch funcione
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include 'api/db_connect.php'; // Incluimos la conexión

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($username) || empty($email) || empty($password)) {
    die("Por favor, completa todos los campos.");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Intentamos ejecutar la inserción en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $stmt->execute();

    // Si todo va bien, redirigimos al login
    header("Location: login.php?registro=exitoso");
    exit();

} catch (mysqli_sql_exception $e) {
    // Atrapamos la excepción de la base de datos
    if ($e->getCode() == 1062) { // 1062 es el código para "Entrada Duplicada"
        echo "Error: El nombre de usuario o el email ya están registrados. <a href='register.php'>Intenta de nuevo</a>";
    } else {
        // Para cualquier otro error de base de datos
        echo "Error en la base de datos: " . $e->getMessage();
    }
}

$conn->close();
?>