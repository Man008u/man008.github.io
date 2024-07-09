<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Tabla de Productos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<!-- Formulario de búsqueda -->
<div id="Div0001">
    <div id="Div0002">
        <form action="" method="GET">
            <label for="search">Buscar:</label>
            <input type="text" id="search" name="search" required>
            <button type="submit" id="Button001">Buscar</button>
        </form>
    </div>
</div>

<div id="Div0003">
    <div id="Div0004">
        <h2>Agregar Producto</h2>
        <form action="add_product.php" method="POST">
            <label for="name">Nombre del producto:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" step="0.01" required><br><br>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required></textarea><br><br>
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>
    <div id="dalete">
        <form action="delete_record.php" method="POST">
            <label for="id">ID del registro a eliminar:</label>
            <input type="number" id="id" name="id" required>
            <button type="submit">Eliminar</button>
        </form>
    </div>
<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Código de Barras</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>
<?php
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

$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $sql = "SELECT id, Nombre, CgBarras, Precio FROM producto WHERE CgBarras LIKE '%" . $conn->real_escape_string($search) . "%'";
} else {
    $sql = "SELECT id, Nombre, CgBarras, Precio FROM producto";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["Nombre"]. "</td>";
        echo "<td>" . $row["CgBarras"]. "</td>";
        echo "<td>" . $row["Precio"]. "</td>";
        echo "<td>";
        echo "<form action='edit_product.php' method='POST' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='text' name='name' value='" . $row["Nombre"] . "' required>";
        echo "<input type='text' name='cgbarras' value='" . $row["CgBarras"] . "' required>";
        echo "<input type='number' name='price' step='0.01' value='" . $row["Precio"] . "' required>";
        echo "<button type='submit'>Guardar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>0 resultados</td></tr>";
}
$conn->close();
?>
</table>

</body>
</html>

