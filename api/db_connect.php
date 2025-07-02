<?php
// Ya NO ponemos el header aquí.

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "spotify_db";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    // Es mejor no usar die() aquí para que las páginas HTML puedan manejar el error
    // die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}
?>