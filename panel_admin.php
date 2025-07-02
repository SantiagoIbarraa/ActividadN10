<?php
session_start();

// GATEKEEPER: Proteger la página. Si no es admin, lo expulsa.
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'root') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Spotify Clon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input[type="file"]::-webkit-file-upload-button { -webkit-appearance: none; appearance: none; }
    </style>
</head>
<body class="bg-black text-white font-sans">
    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        
        <div class="flex justify-between items-center mb-8 gap-4">
            <h1 class="text-4xl font-black">Panel de Administrador</h1>
            <div class="flex items-center gap-4">
                <a href="index.php" class="bg-neutral-700 hover:bg-neutral-600 text-white font-bold py-2 px-5 rounded-full text-sm transition-colors">
                    Ir al Reproductor
                </a>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-full text-sm transition-colors">
                    Cerrar Sesión
                </a>
            </div>
        </div>

        <div class="bg-neutral-900 p-6 md:p-8 rounded-xl shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Agregar Nueva Canción</h2>
            
            <?php if(isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                    <div class="bg-green-500/20 text-green-400 text-sm p-3 rounded-md mb-6">
                        <strong>¡Éxito!</strong> La canción fue agregada correctamente a la base de datos.
                    </div>
                <?php elseif ($_GET['status'] == 'error'): ?>
                     <div class="bg-red-500/20 text-red-400 text-sm p-3 rounded-md mb-6">
                        <strong>Error:</strong> Hubo un problema al subir los archivos o guardar los datos. Revisa los permisos de las carpetas.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="add_song_process.php" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <label for="titulo" class="block text-neutral-400 text-sm font-semibold mb-2">Título de la Canción</label>
                        <input type="text" name="titulo" id="titulo" class="w-full p-3 bg-neutral-800 border-0 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition-shadow" required>
                    </div>
                    <div>
                        <label for="artista" class="block text-neutral-400 text-sm font-semibold mb-2">Nombre del Artista</label>
                        <input type="text" name="artista" id="artista" class="w-full p-3 bg-neutral-800 border-0 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition-shadow" required>
                    </div>
                    <div>
                        <label for="album" class="block text-neutral-400 text-sm font-semibold mb-2">Nombre del Álbum</label>
                        <input type="text" name="album" id="album" class="w-full p-3 bg-neutral-800 border-0 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition-shadow" required>
                    </div>
                     <div>
                        <label for="duracion" class="block text-neutral-400 text-sm font-semibold mb-2">Duración (ej: 3:31)</label>
                        <input type="text" name="duracion" id="duracion" class="w-full p-3 bg-neutral-800 border-0 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition-shadow" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="archivo_mp3" class="block text-neutral-400 text-sm font-semibold mb-2">Archivo de Audio (.mp3)</label>
                        <input type="file" name="archivo_mp3" id="archivo_mp3" 
                               class="w-full text-sm text-neutral-400 file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                      file:bg-neutral-700 file:text-white hover:file:bg-neutral-600" required>
                    </div>
                     <div class="md:col-span-2">
                        <label for="portada_album" class="block text-neutral-400 text-sm font-semibold mb-2">Portada del Álbum (.jpg, .png)</label>
                         <input type="file" name="portada_album" id="portada_album" 
                               class="w-full text-sm text-neutral-400 file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                      file:bg-neutral-700 file:text-white hover:file:bg-neutral-600" required>
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded-full transition-transform hover:scale-105">
                        Agregar Canción
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>