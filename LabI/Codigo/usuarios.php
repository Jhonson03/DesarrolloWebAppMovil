<?php
require 'conexion.php'; 

date_default_timezone_set('America/El_Salvador');

// Obtener lista de departamentos
$queryDepartamentos = "SELECT Id, Nombre FROM Departamentos";
$resultDepartamentos = $conn->query($queryDepartamentos);

$departamentoId = isset($_POST['departamento']) ? $_POST['departamento'] : null;
$municipioId = isset($_POST['municipio']) ? $_POST['municipio'] : null;

// Obtener lista de municipios filtrados por departamento
$queryMunicipios = "SELECT Id, Nombre FROM Municipios WHERE DepartamentoId = ?";
$stmtMunicipios = $conn->prepare($queryMunicipios);
$stmtMunicipios->bind_param("i", $departamentoId);
$stmtMunicipios->execute();
$resultMunicipios = $stmtMunicipios->get_result();

// Obtener lista de distritos filtrados por municipio
$queryDistritos = "SELECT Id, Nombre FROM Distritos WHERE MunicipioId = ?";
$stmtDistritos = $conn->prepare($queryDistritos);
$stmtDistritos->bind_param("i", $municipioId);
$stmtDistritos->execute();
$resultDistritos = $stmtDistritos->get_result();

// Mantener los valores ingresados por el usuario
$nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
$edad = isset($_POST['edad']) ? $_POST['edad'] : '';
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$distritoId = isset($_POST['distrito']) ? $_POST['distrito'] : '';
$activo = isset($_POST['activo']) ? 1 : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
    $fechaCreacion = date('Y-m-d'); 

    // Insertar usuario
    $queryUsuario = "INSERT INTO Usuarios (Nombres, Apellidos, Edad, Sexo, Correo, Direccion, DepartamentoId, MunicipioId, DistritoId, FechaCreacion, Activo) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($queryUsuario);
    $stmt->bind_param("ssisssiiisi", $nombres, $apellidos, $edad, $sexo, $correo, $direccion, $departamentoId, $municipioId, $distritoId, $fechaCreacion, $activo);

    if ($stmt->execute()) {
        header("Location: mostrarUsuarios.php?success=1");
        exit();
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Usuario</title>
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="Styles/styleUsuarios.css">
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
        <h1>Formulario de Registro de Usuario</h1>
        <form action="" method="post">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="<?= htmlspecialchars($nombres) ?>" required><br><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($apellidos) ?>" required><br><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?= htmlspecialchars($edad) ?>" required><br><br>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="masculino" <?= ($sexo == "masculino") ? "selected" : "" ?>>Masculino</option>
                <option value="femenino" <?= ($sexo == "femenino") ? "selected" : "" ?>>Femenino</option>
            </select><br><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($correo) ?>" required><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($direccion) ?>" required><br><br>

            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" onchange="this.form.submit()" required>
                <option value="">Seleccione un departamento</option>
                <?php while ($row = $resultDepartamentos->fetch_assoc()) { ?>
                    <option value="<?= $row['Id'] ?>" <?= ($row['Id'] == $departamentoId) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['Nombre']) ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="municipio">Municipio:</label>
            <select id="municipio" name="municipio" onchange="this.form.submit()" required>
                <option value="">Seleccione un municipio</option>
                <?php while ($row = $resultMunicipios->fetch_assoc()) { ?>
                    <option value="<?= $row['Id'] ?>" <?= ($row['Id'] == $municipioId) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['Nombre']) ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="distrito">Distrito:</label>
            <select id="distrito" name="distrito" required>
                <option value="">Seleccione un distrito</option>
                <?php while ($row = $resultDistritos->fetch_assoc()) { ?>
                    <option value="<?= $row['Id'] ?>" <?= ($row['Id'] == $distritoId) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['Nombre']) ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="creacion">Fecha de Creación:</label>
            <input type="date" id="creacion" name="creacion" value="<?= date('Y-m-d') ?>" readonly><br><br>

            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" name="activo" <?= ($activo == 1) ? 'checked' : '' ?>><br><br>

            <button type="submit" name="registro">Registrar Usuario</button>
        </form>
    </div>
</body>
</html>
