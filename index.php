<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #535353; border-radius: 10px; }
        #main-content { overflow-y: auto; }
        .song-card .play-button, .song-card .like-button { opacity: 0; transition: opacity 0.3s; }
        .song-card:hover .play-button, .song-card:hover .like-button { opacity: 1; }
        .playlist-header-bg { background-image: linear-gradient(to bottom, #500075 0%, #1c002c 50%, transparent 100%); }
    </style>
</head>
<body class="bg-black text-white font-sans h-screen flex flex-col">
    <div class="flex flex-1 overflow-hidden">
        <?php include 'includes/sidebar.php'; ?>
        
        <!-- El "escenario" donde JavaScript inyectará todo el contenido dinámico -->
        <main id="main-content" class="flex-1 bg-neutral-900 rounded-lg my-2 mr-2 flex flex-col">
            <!-- El contenido de home.php, liked-songs.php, etc., se cargará aquí -->
        </main>
    </div>

    <?php include 'includes/player.php'; ?>
    <script src="js/app.js"></script>
</body>
</html>
