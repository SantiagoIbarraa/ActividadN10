<?php
session_start();
include 'api/db_connect.php';

// GATEKEEPER: Solo admins pueden ejecutar esto
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit();
}

// Obtener datos del formulario
$titulo_cancion = $_POST['titulo'];
$nombre_artista = $_POST['artista'];
$nombre_album = $_POST['album'];
$duracion = $_POST['duracion'];

// --- MANEJO DE ARCHIVOS ---
// Ruta donde se guardarán los archivos
$target_dir_music = "assets/music/";
$target_dir_images = "assets/images/";

// Crear las carpetas si no existen
if (!is_dir($target_dir_music)) mkdir($target_dir_music, 0777, true);
if (!is_dir($target_dir_images)) mkdir($target_dir_images, 0777, true);

// Construir rutas finales
$mp3_filename = basename($_FILES["archivo_mp3"]["name"]);
$cover_filename = basename($_FILES["portada_album"]["name"]);
$path_mp3 = $target_dir_music . $mp3_filename;
$path_cover = $target_dir_images . $cover_filename;

// Mover archivos subidos a su destino final
if (!move_uploaded_file($_FILES["archivo_mp3"]["tmp_name"], $path_mp3)) {
    header("Location: panel_admin.php?status=error"); exit();
}
if (!move_uploaded_file($_FILES["portada_album"]["tmp_name"], $path_cover)) {
    header("Location: panel_admin.php?status=error"); exit();
}


// --- LÓGICA DE BASE DE DATOS ---

// 1. Manejar Artista
$artist_id = null;
$stmt = $conn->prepare("SELECT id FROM artists WHERE name = ?");
$stmt->bind_param("s", $nombre_artista);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $artist_id = $result->fetch_assoc()['id'];
} else {
    $stmt = $conn->prepare("INSERT INTO artists (name) VALUES (?)");
    $stmt->bind_param("s", $nombre_artista);
    $stmt->execute();
    $artist_id = $stmt->insert_id;
}

// 2. Manejar Álbum
$album_id = null;
$stmt = $conn->prepare("SELECT id FROM albums WHERE title = ? AND artist_id = ?");
$stmt->bind_param("si", $nombre_album, $artist_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $album_id = $result->fetch_assoc()['id'];
} else {
    $stmt = $conn->prepare("INSERT INTO albums (title, artist_id, cover_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nombre_album, $artist_id, $path_cover);
    $stmt->execute();
    $album_id = $stmt->insert_id;
}

// 3. Determinar el orden en el álbum
$stmt = $conn->prepare("SELECT MAX(album_order) as max_order FROM songs WHERE album_id = ?");
$stmt->bind_param("i", $album_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$album_order = ($result['max_order'] ?? 0) + 1;


// 4. Insertar la Canción
$stmt = $conn->prepare("INSERT INTO songs (title, artist_id, album_id, duration, file_path, album_order) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siissi", $titulo_cancion, $artist_id, $album_id, $duracion, $path_mp3, $album_order);

if ($stmt->execute()) {
    header("Location: panel_admin.php?status=success");
} else {
    header("Location: panel_admin.php?status=error");
}

$stmt->close();
$conn->close();
?>