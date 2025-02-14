<?php
require 'conexion.php';

// Consulta para obtener los usuarios
$sql = "SELECT u.Nombres, u.Apellidos, u.Edad, u.Sexo, u.Correo, 
               d.Nombre AS Departamento, m.Nombre AS Municipio, di.Nombre AS Distrito, 
               u.FechaCreacion, u.Activo
        FROM Usuarios u
        LEFT JOIN Departamentos d ON u.DepartamentoId = d.Id
        LEFT JOIN Municipios m ON u.MunicipioId = m.Id
        LEFT JOIN Distritos di ON u.DistritoId = di.Id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="Styles/styleMostrar.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="usuarios.php">Formulario</a></li>
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
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Nombres']); ?></td>
                    <td><?php echo htmlspecialchars($row['Apellidos']); ?></td>
                    <td><?php echo htmlspecialchars($row['Edad']); ?></td>
                    <td><?php echo htmlspecialchars($row['Sexo']); ?></td>
                    <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['Departamento'] ?? 'No Asignado'); ?></td>
                    <td><?php echo htmlspecialchars($row['Municipio'] ?? 'No Asignado'); ?></td>
                    <td><?php echo htmlspecialchars($row['Distrito'] ?? 'No Asignado'); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['FechaCreacion'])); ?></td>
                    <td><?php echo $row['Activo'] ? 'Sí' : 'No'; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
