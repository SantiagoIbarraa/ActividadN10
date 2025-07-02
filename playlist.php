<?php
// Obtener el ID del álbum desde la URL. Si no existe, usamos 1 como default.
$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']) : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clon - Playlist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #535353; border-radius: 10px; }
        ::-webkit-scrollbar-track { background-color: #1a1a1a; }
        .main-content-scroll { overflow-y: auto; height: calc(100vh - 90px); }
        .playlist-header-bg { background-image: linear-gradient(to bottom, #500075 0%, #1c002c 50%, transparent 100%); }
        .song-row:hover { background-color: #2a2a2a; }
        .song-row.playing { background-color: #2a2a2a; color: #1DB954; }
        .song-row.playing .text-neutral-400 { color: #1DB954; }
    </style>
</head>
<body class="bg-black text-white font-sans overflow-hidden">

    <div class="flex h-screen">
        
        <?php include 'includes/sidebar.php'; ?>

        <main id="main-content" class="flex-1 bg-neutral-900 rounded-lg m-2 mr-0 mb-0 flex flex-col">
            <?php include 'includes/header.php'; ?>
            <div class="flex-1 main-content-scroll">
                <div id="playlist-header" class="p-6 pt-16 pb-8 flex items-end space-x-6 playlist-header-bg">
                    <img id="playlist-cover" src="https://placehold.co/232x232/121212/121212/png" alt="Playlist Cover" class="w-56 h-56 shadow-2xl">
                    <div>
                        <p class="text-sm uppercase font-semibold text-white">Álbum</p>
                        <h1 id="playlist-name" class="text-7xl font-black text-white leading-tight mt-2 mb-4">Cargando...</h1>
                        <p id="playlist-info" class="text-neutral-300 text-sm"></p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-6 mb-8">
                        <button id="mainPlayBtn" class="bg-green-500 text-black p-4 rounded-full hover:scale-105 transition duration-200">
                            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.025A1 1 0 008 8v4a1 1 0 001.555.975l3.5-2a1 1 0 000-1.95l-3.5-2z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <div id="playlist-songs-container" class="mt-6">
                        <div class="grid grid-cols-[16px,minmax(0,2fr),minmax(0,1.5fr),minmax(0,1fr)] items-center gap-x-4 border-b border-neutral-700 pb-2 text-neutral-400 text-sm font-semibold px-4">
                            <div class="text-right">#</div>
                            <div>Título</div>
                            <div>Álbum</div>
                            <div class="text-right"><svg class="h-4 w-4 inline-block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a.75.75 0 01.75.75v14.5a.75.75 0 01-1.5 0V2.75A.75.75 0 0110 2z"></path></svg></div>
                        </div>
                        <div id="playlist-songs" class="space-y-1 mt-2"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include 'includes/player.php'; ?>

    <script src="js/app.js"></script>

</body>
</html>