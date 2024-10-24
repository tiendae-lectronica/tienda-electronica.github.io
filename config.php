<?php
$servername = "sql211.infinityfree.com";
$username = "si0_37581475";
$password = "if0_37581475";
$dbname = "if0_37581475_tienda_electronica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>