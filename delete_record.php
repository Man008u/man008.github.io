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

// Obtener el ID del formulario
$id = $_POST['id'];

// Preparar y ejecutar la consulta SQL para eliminar el registro
$sql = "DELETE FROM producto WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute() === TRUE) {
    echo "Registro eliminado correctamente.";
    
    // Llamar al procedimiento almacenado para resetear AUTO_INCREMENT
    $reset_sql = "CALL ResetAutoIncrement()";
    if ($conn->query($reset_sql) === TRUE) {
        echo "AUTO_INCREMENT reseteado correctamente.";
    } else {
        echo "Error al resetear AUTO_INCREMENT: " . $conn->error;
    }
} else {
    echo "Error al eliminar el registro: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
