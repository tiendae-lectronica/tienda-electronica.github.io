<?php


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