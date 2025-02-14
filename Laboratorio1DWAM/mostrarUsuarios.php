<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="vistas/styles.css">
    <link rel="stylesheet" href="vistas/styleMostrar.css">
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
        <h1>Lista de Usuarios Registrados</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Distrito</th>
                    <th>Creación</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se irían llenando los usuarios -->
                <tr>
                    <td>Juan</td>
                    <td>Pérez</td>
                    <td>30</td>
                    <td>Masculino</td>
                    <td>juan@example.com</td>
                    <td>La Paz</td>
                    <td>Municipio 1</td>
                    <td>Distrito A</td>
                    <td>2025-02-13</td>
                    <td>Sí</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
