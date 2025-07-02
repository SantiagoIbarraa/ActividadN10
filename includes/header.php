<?php
// Es una buena práctica asegurarse de que la sesión esté iniciada en cualquier
// archivo que la utilice, aunque ya lo hayamos hecho en index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="bg-neutral-800/50 p-4 rounded-t-lg flex items-center justify-between sticky top-0 z-10">
    
    <div class="flex items-center space-x-4">
        <div class="flex space-x-2">
            <button class="bg-black text-neutral-400 rounded-full p-1 hover:text-white">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            </button>
            <button class="bg-black text-neutral-400 rounded-full p-1 hover:text-white">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <?php if (isset($_SESSION['user_id'])): ?>
            
            <span class="text-white font-semibold text-sm">
                Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
            </span>

            <?php if ($_SESSION['rol'] === 'root'): ?>
                <a href="panel_admin.php" class="bg-yellow-500 text-black text-sm font-semibold px-4 py-2 rounded-full hover:scale-105 transition duration-200">
                    Panel Admin
                </a>
                <?php endif; ?>
            
            <a href="logout.php" class="bg-white text-black text-sm font-semibold px-4 py-2 rounded-full hover:scale-105 transition duration-200">
                Cerrar Sesión
            </a>
            <?php else: ?>

            <a href="register.php" class="text-neutral-400 hover:text-white text-sm font-semibold transition duration-200">
                Registrarse
            </a>
            <a href="login.php" class="bg-white text-black text-sm font-semibold px-4 py-2 rounded-full hover:scale-105 transition duration-200">
                Iniciar Sesión
            </a>
            <?php endif; ?>
    </div>
</header>