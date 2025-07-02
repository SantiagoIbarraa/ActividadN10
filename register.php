<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Spotify Clon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex items-center justify-center h-screen">
    <div class="bg-neutral-900 p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-white text-2xl font-bold mb-6 text-center">Crear una cuenta</h2>
        <form action="register_process.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-neutral-400 text-sm font-bold mb-2">Nombre de Usuario</label>
                <input type="text" name="username" id="username" class="w-full p-3 bg-neutral-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-neutral-400 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full p-3 bg-neutral-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-neutral-400 text-sm font-bold mb-2">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full p-3 bg-neutral-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded-full transition duration-200">
                Registrarse
            </button>
        </form>
        <p class="text-neutral-400 text-center mt-6">
            ¿Ya tienes una cuenta? <a href="login.php" class="text-green-500 hover:underline">Inicia sesión</a>
        </p>
    </div>
</body>
</html>