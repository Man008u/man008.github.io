<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pruevatrebol";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

// Preparar y ejecutar la consulta SQL para insertar el producto
$sql = "INSERT INTO producto (Nombre, CgBarras, Precio) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sds", $name, $price, $description);

if ($stmt->execute() === TRUE) {
    echo "Producto agregado correctamente.";
} else {
    echo "Error al agregar el producto: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
