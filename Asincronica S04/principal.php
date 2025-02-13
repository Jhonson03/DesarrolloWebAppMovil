<?php
session_start();
include 'conexion.php';

// Obtener categorías de la base de datos
$stmt = $conn->prepare("SELECT Id, Nombre FROM Categoria");
$stmt->execute();
$resultado = $stmt->get_result();
$categorias = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoriaId = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $fecha = $_POST['fecha'];
    $activo = isset($_POST['activo']) ? 1 : 0;


    $imagenRuta = NULL;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $directorioDestino = 'uploads/'; 
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0777, true); 
        }

        $nombreImagen = basename($_FILES['imagen']['name']);
        $imagenRuta = $directorioDestino . $nombreImagen;

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenRuta)) {
            echo "Error al subir la imagen.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO pedidos (CategoriaId, Nombre, Descripcion, Precio, FechaCreacion, Imagen, Activo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdssi", $categoriaId, $nombre, $descripcion, $precio, $fecha, $imagenRuta, $activo);

    if ($stmt->execute()) {
        header('Location: pedidos.php');
        exit();
    } else {
        echo "Error al insertar pedido.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Pedido</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Nuevo Pedido</h1>
    <form method="post" action="principal.php" enctype="multipart/form-data">
        <label>Categoría:</label>
        <select name="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['Id']; ?>"><?php echo $categoria['Nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label>Nombre del Producto:</label>
        <input type="text" name="nombre" required>

        <label>Descripción breve:</label>
        <textarea name="descripcion" required></textarea>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <label>Fecha de creación:</label>
        <input type="date" name="fecha" required>

        <label for="imagen">Imagen del producto:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*">

        <label>Activo:</label>
        <input type="checkbox" name="activo">

        <button type="submit">Agregar Pedido</button>
    </form>
    <br>
    <a href="index.php">Volver a Inicio</a>
    <br>
    <a href="pedidos.php">Ver pedidos</a>
</body>
</html>
