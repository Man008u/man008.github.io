<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pruevatrebol";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("conexcion fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$name = $_POST['name'];
$cgbarras = $_POST['cgbarras'];
$price = $_POST['price'];

// Preparar y ejecutar la consulta SQL para actualizar el producto
$sql = "UPDATE producto SET Nombre=?, CgBarras=?, Precio=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $name, $cgbarras, $price, $id);

if ($stmt->execute() === TRUE) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
