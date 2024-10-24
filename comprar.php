<?php
include 'config.php';

// Obtener producto y precio de la URL
$producto = isset($_GET['producto']) ? $_GET['producto'] : '';
$precio = isset($_GET['precio']) ? $_GET['precio'] : '';

// Limpiar el formato de la moneda y comas para dejar el precio como número
if (!empty($precio)) {
    $precio = str_replace('LPS ', '', $precio);  // Eliminar "LPS"
    $precio = str_replace(',', '', $precio);  // Eliminar comas
    $precio = (float)$precio; // Convertir a número
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $producto = $_POST['producto'];
    $precio = (float)$_POST['precio'];

    // Consulta para insertar en la base de datos
    $sql = "INSERT INTO pedidos (nombre, email, telefono, direccion, ciudad, codigo_postal, pais, producto, precio)
            VALUES ('$nombre', '$email', '$telefono', '$direccion', '$ciudad', '$codigo_postal', '$pais', '$producto', '$precio')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pedido realizado con éxito');</script>";
    } else {
        echo "<script>alert('Error al realizar el pedido: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Producto - Tienda de Electrónicos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Comprar Producto</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="productos.html">Productos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main class="purchase-main">
        <h2>Formulario de Compra</h2>
        <form class="purchase-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de envío:</label>
                <textarea id="direccion" name="direccion" required></textarea>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Código Postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" required>
            </div>
            <div class="form-group">
                <label for="producto">Producto:</label>
                <input type="text" id="producto" name="producto" value="<?php echo htmlspecialchars($producto); ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($precio); ?>" required>
            </div>
            <button type="submit" class="btn">Finalizar Compra</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Tienda de Electrónicos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
