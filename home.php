<?php
require 'api/db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id'] ?? 0;

$liked_songs_ids = [];
if ($user_id > 0) {
    $stmt_likes = $conn->prepare("SELECT song_id FROM user_liked_songs WHERE user_id = ?");
    $stmt_likes->bind_param("i", $user_id);
    $stmt_likes->execute();
    $result_likes = $stmt_likes->get_result();
    while ($row = $result_likes->fetch_assoc()) {
        $liked_songs_ids[] = $row['song_id'];
    }
    $stmt_likes->close();
}

$todas_las_canciones = [];
$sql = "SELECT s.id as song_id, s.title as song_title, s.file_path, s.duration, 
               a.name as artist_name, al.title as album_title, al.cover_path
        FROM songs s JOIN artists a ON s.artist_id = a.id JOIN albums al ON s.album_id = al.id
        ORDER BY s.id DESC";
$result = $conn->query($sql);
if ($result) {
    $todas_las_canciones = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>
<!-- El header sí va aquí, porque es parte del contenido que cambia -->
<?php include 'includes/header.php'; ?>

<!-- El div con el scroll también es parte del contenido dinámico -->
<div class="flex-1 overflow-y-auto p-6">
    <h2 class="text-3xl font-bold mb-6">Toda la música</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        <?php foreach ($todas_las_canciones as $song): ?>
            <?php 
                // Esta lógica PHP determina el estado inicial del botón
                $is_liked = in_array($song['song_id'], $liked_songs_ids);
                $button_text = $is_liked ? 'Me gusta' : 'No me gusta';
                $button_classes = $is_liked 
                    ? 'bg-green-500 text-black' 
                    : 'bg-neutral-700 text-white hover:bg-neutral-600';
                
                // CORRECCIÓN: Estructurar datos con nombres consistentes para JavaScript
                $song_data_for_js = [
                    'song_id' => $song['song_id'],
                    'id' => $song['song_id'], // Alias para compatibilidad
                    'song_title' => $song['song_title'],
                    'title' => $song['song_title'], // Alias para compatibilidad
                    'artist_name' => $song['artist_name'],
                    'artist' => $song['artist_name'], // Alias para compatibilidad
                    'album_title' => $song['album_title'],
                    'album' => $song['album_title'], // Alias para compatibilidad
                    'file_path' => $song['file_path'],
                    'duration' => $song['duration'],
                    'cover_path' => $song['cover_path']
                ];
            ?>
            <div class="song-card-container bg-neutral-800/50 p-4 rounded-lg group flex flex-col hover:bg-neutral-700/70 transition-colors">
                
                <div class="song-card relative mb-4" data-song='<?php echo htmlspecialchars(json_encode($song_data_for_js), ENT_QUOTES, 'UTF-8'); ?>'>
                    <img src="<?php echo htmlspecialchars($song['cover_path']); ?>" alt="Cover" class="w-full rounded-md shadow-lg aspect-square object-cover cursor-pointer">
                    <button class="play-button absolute right-2 h-12 w-12 bg-green-500 rounded-full flex items-center justify-center shadow-xl cursor-pointer" style="bottom: 0.75rem;">
                        <svg class="h-6 w-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.5,7.6L12.5,10L8.5,12.4V7.6z M10,0.5C4.7,0.5,0.5,4.7,0.5,10c0,5.3,4.2,9.5,9.5,9.5s9.5-4.2,9.5-9.5C19.5,4.7,15.3,0.5,10,0.5z"/>
                        </svg>
                    </button>
                </div>

                <div class="flex-grow">
                    <h3 class="font-bold text-white text-base truncate"><?php echo htmlspecialchars($song['song_title']); ?></h3>
                    <p class="text-sm text-neutral-400 mt-1 line-clamp-2"><?php echo htmlspecialchars($song['artist_name']); ?></p>
                </div>

                <div class="flex justify-end mt-4">
                    <button class="like-button p-1 hover:scale-110 transition-transform" data-song-id="<?php echo $song['song_id']; ?>" title="<?php echo $is_liked ? 'Quitar de Me Gusta' : 'Agregar a Me Gusta'; ?>">
                        <svg class="h-5 w-5 <?php echo $is_liked ? 'text-green-500' : 'text-neutral-500 hover:text-white'; ?>" fill="currentColor" viewBox="0 0 20 20">
                            <?php if ($is_liked): ?>
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            <?php else: ?>
                                <path d="M10 3.22l-.61-.63a5.5 5.5 0 00-7.78 7.78l8.39 8.39 8.39-8.39a5.5 5.5 0 00-7.78-7.78l-.61-.63zM10 18.28l-8.39-8.39a4 4 0 010-5.66 4 4 0 015.66 0l.73.73.73-.73a4 4 0 015.66 0 4 4 0 010 5.66L10 18.28z"></path>
                            <?php endif; ?>
                        </svg>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- SCRIPT PARA INICIALIZAR LA PLAYLIST CON TODAS LAS CANCIONES -->
<script>
    // Pasar todas las canciones a JavaScript para que funcione como playlist
    window.pagePlaylistData = <?php echo json_encode($todas_las_canciones); ?>;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar que los datos lleguen correctamente
        console.log('Playlist data loaded:', window.pagePlaylistData);
        
        // Event listener adicional para debug de clics en cards
        document.querySelectorAll('.song-card').forEach((card, index) => {
            card.addEventListener('click', function(e) {
                console.log('Card clicked:', index, JSON.parse(this.dataset.song));
            });
        });
    });
</script>