<?php
include 'db_connect.php';

// Validar que album_id sea un entero
$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']) : 0;

if ($album_id <= 0) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'ID de álbum inválido.']);
    exit;
}

// Usar sentencias preparadas para prevenir inyección SQL
$sql = "SELECT s.id, s.title, a.name AS artist, s.duration, s.file_path, al.title as album, al.cover_path
        FROM songs s
        JOIN artists a ON s.artist_id = a.id
        JOIN albums al ON s.album_id = al.id
        WHERE s.album_id = ?
        ORDER BY s.album_order ASC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $album_id);
$stmt->execute();
$result = $stmt->get_result();

$songs = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

// Si no hay canciones, devolvemos un array vacío en lugar de un error
echo json_encode($songs);

$stmt->close();
$conn->close();
?>