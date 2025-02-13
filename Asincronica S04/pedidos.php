<?php
include 'conexion.php';

// Obtener pedidos de la base de datos
$sql = "SELECT ped.Id, c.Nombre AS Categoria, ped.Nombre AS Producto, ped.Descripcion, ped.Precio, ped.Imagen 
        FROM pedidos ped 
        JOIN categoria c ON ped.CategoriaId = c.Id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Lista de Pedidos</h1>
    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Nombre del Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pedido = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $pedido['Categoria']; ?></td>
                    <td><?php echo $pedido['Producto']; ?></td>
                    <td><?php echo $pedido['Descripcion']; ?></td>
                    <td><?php echo number_format($pedido['Precio'], 2); ?> $</td>
                    <td>
                        <?php if ($pedido['Imagen']): ?>
                            <img src="uploads/<?php echo basename($pedido['Imagen']); ?>" alt="Imagen de <?php echo $pedido['Producto']; ?>" width="100">
                        <?php else: ?>
                            <p>No disponible</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No hay pedidos registrados.</p>
    <?php endif; ?>
    <br>
    <a href="principal.php">Agregar Nuevo Pedido</a>
    <br>
    <a href="index.php">Volver a Inicio</a>
</body>
</html>

<?php $conn->close(); ?>
