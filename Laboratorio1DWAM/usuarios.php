<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Usuario</title>
    <link rel="stylesheet" href="vistas/styles.css">
    <link rel="stylesheet" href="vistas/styleUsuarios.css">
</head>
<body>
    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="index.php">Formulario</a></li>
            <li><a href="mostrarUsuarios.php">Usuarios Registrados</a></li>
            <li><a href="about.php">Sobre los Desarrolladores</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Formulario de Registro de Usuario</h1>
        <form action="controladores/UsuarioController.php" method="post">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required><br><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required><br><br>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select><br><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br><br>

            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required><br><br>

            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" name="municipio" required><br><br>

            <label for="distrito">Distrito:</label>
            <input type="text" id="distrito" name="distrito" required><br><br>

            <label for="creacion">Fecha de Creación:</label>
            <input type="date" id="creacion" name="creacion" required><br><br>

            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" name="activo" checked><br><br>

            <button type="submit">Registrar Usuario</button>
        </form>
    </div>
</body>
</html>
