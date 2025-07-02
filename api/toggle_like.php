<?php
// api/toggle_like.php
header('Content-Type: application/json');
require 'db_connect.php';

// Asegurarse de que la sesión esté iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

// Verificar que se reciba el ID de la canción
if (!isset($_POST['song_id']) || !is_numeric($_POST['song_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de canción inválido']);
    exit();
}

$user_id = $_SESSION['user_id'];
$song_id = intval($_POST['song_id']);

try {
    // Verificar si la canción ya está en "Me Gusta"
    $check_stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_liked_songs WHERE user_id = ? AND song_id = ?");
    $check_stmt->bind_param("ii", $user_id, $song_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();
    $is_liked = $row['count'] > 0;
    
    if ($is_liked) {
        // Quitar de "Me Gusta"
        $delete_stmt = $conn->prepare("DELETE FROM user_liked_songs WHERE user_id = ? AND song_id = ?");
        $delete_stmt->bind_param("ii", $user_id, $song_id);
        $delete_stmt->execute();
        
        echo json_encode([
            'success' => true, 
            'action' => 'removed',
            'message' => 'Canción quitada de Me Gusta'
        ]);
    } else {
        // Agregar a "Me Gusta"
        $insert_stmt = $conn->prepare("INSERT INTO user_liked_songs (user_id, song_id) VALUES (?, ?)");
        $insert_stmt->bind_param("ii", $user_id, $song_id);
        $insert_stmt->execute();
        
        echo json_encode([
            'success' => true, 
            'action' => 'added',
            'message' => 'Canción agregada a Me Gusta'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}

$conn->close();
?>