<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $mensaje = $_POST['message'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Mensaje enviado con éxito');</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje: " . $stmt->error . "');</script>";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Tienda de Electrónicos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Contacto</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="productos.html">Productos</a></li>
                <li><a href="contacto.php">Contacto</a></li> <!-- Cambiado a contacto.php -->
            </ul>
        </nav>
    </header>
    <main class="contact-main">
        <h2>Contáctanos</h2>
        <form class="contact-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit" class="btn">Enviar mensaje</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Tienda de Electrónicos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
