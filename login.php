<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Spotify Clon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex items-center justify-center h-screen">
    <div class="bg-neutral-900 p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-white text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>
        <?php if(isset($_GET['error'])) { echo '<p class="text-red-500 text-center mb-4">Usuario o contraseña incorrectos.</p>'; } ?>
        <?php if(isset($_GET['registro']) && $_GET['registro'] == 'exitoso') { echo '<p class="text-green-500 text-center mb-4">¡Registro exitoso! Por favor, inicia sesión.</p>'; } ?>
        <form action="login_process.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-neutral-400 text-sm font-bold mb-2">Nombre de Usuario o Email</label>
                <input type="text" name="username" id="username" class="w-full p-3 bg-neutral-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-neutral-400 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full p-3 bg-neutral-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded-full transition duration-200">
                Iniciar Sesión
            </button>
        </form>
        <p class="text-neutral-400 text-center mt-6">
            ¿No tienes una cuenta? <a href="register.php" class="text-green-500 hover:underline">Regístrate</a>
        </p>
    </div>
</body>
</html>