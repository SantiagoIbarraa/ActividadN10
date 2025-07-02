<?php
// Asegurarnos de que la sesión esté disponible
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<aside class="w-72 bg-black p-2 flex flex-col space-y-2">
    <!-- Navegación Principal: Inicio y Buscar -->
    <div class="bg-neutral-900 rounded-lg p-2">
        <nav class="space-y-1 p-2">
            <a href="home.php" class="flex items-center space-x-4 text-white hover:text-white text-sm font-bold p-2 rounded-md">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                <span>Inicio</span>
            </a>
            <a href="#" class="flex items-center space-x-4 text-neutral-400 hover:text-white text-sm font-bold p-2 rounded-md">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.39L19.707 19l-1.414 1.414-5.25-5.25A7 7 0 012 9z" clip-rule="evenodd"></path></svg>
                <span>Buscar</span>
            </a>
        </nav>
    </div>

    <!-- Tu Biblioteca y Playlists -->
    <div class="bg-neutral-900 rounded-lg flex-grow p-2">
        <div class="flex items-center justify-between p-2">
            <a href="#" class="flex items-center gap-4 text-neutral-400 font-semibold hover:text-white">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.5 3.25a.75.75 0 00-1.5 0v.516c-4.91.456-8.5 4.543-8.5 9.484 0 4.94 3.59 9.027 8.5 9.484v.516a.75.75 0 001.5 0v-.516c4.91-.457 8.5-4.544 8.5-9.484 0-4.94-3.59-9.027-8.5-9.484V3.25zM4.5 13.25a8.996 8.996 0 018.5-8.983V10.5h1.75a.75.75 0 000-1.5H13V4.267a8.996 8.996 0 018.5 8.983H13a.75.75 0 000 1.5h8.5a8.996 8.996 0 01-8.5 8.983v-4.233H11.5a.75.75 0 000 1.5H13v4.233a8.996 8.996 0 01-8.5-8.983H11a.75.75 0 000-1.5H4.5z"/></svg>
                <span class="text-sm">Tu biblioteca</span>
            </a>
        </div>
        
        <!-- Contenedor con Scroll para las playlists -->
        <div class="px-2 pb-2 overflow-y-auto" style="max-height: calc(100vh - 300px);">
            <div class="space-y-2">
                


                <!-- Aquí podrías añadir un bucle PHP para mostrar otras playlists del usuario si las tuvieras -->
                
            </div>
        </div>
    </div>
</aside>
