<?php // Establece la conexión a la base de datos
$connection = mysqli_connect('servidor', 'usuario', 'contraseña', 'basededatos');

// Verifica la conexión
if (!$connection) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Crea la consulta SQL con los marcadores de posición
$sql = "INSERT INTO tabla (columna1, columna2, columna3, columna4, columna5, columna6) VALUES (?, ?, ?, ?, ?, ?)";

// Prepara la consulta
$query = mysqli_prepare($connection, $sql);

// Verifica si la preparación fue exitosa
if (!$query) {
    die('Error de preparación: ' . mysqli_error($connection));
}

// Vincula los valores a los marcadores de posición
$value1 = 'valor1';
$value2 = 2;
$value3 = 'valor3';
$value4 = 4.5;
$value5 = 'valor5';
$value6 = 6;
mysqli_stmt_bind_param($query, 'sisdsi', $value1, $value2, $value3, $value4, $value5, $value6);

// Ejecuta la consulta preparada
mysqli_stmt_execute($query);

// Cierra la declaración preparada
mysqli_stmt_close($query);

// Cierra la conexión a la base de datos
mysqli_close($connection);
?>


Esto si funciona
<?php
$host="localhost";
$username="id20742267_gvac_us";
$password="Gvac_pass1";
$dbname="id20742267_gvac";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($host,$username,$password,$dbname);

$result = $mysqli->query("SELECT * from materia");

$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $row) {
    //printf("%s (%s)\n", $row["materia_id"], $row["materia_nombre"]);
    echo $row["materia_nombre"]."<br>";
    }
?>

<?php
// MySQLI, de forma procesal
if ($result = mysqli_query($mysqli, $query)) {
  while ($user = mysqli_fetch_object($result, 'Usuario')) {
    echo $user->info() . "\n";
  }
}

// MySQLi, de forma orientado a objetos
if ($result = $mysqli->query($query)) {
  while ($user = $result->fetch_object('Usuario')) {
    echo $user->info() . "\n";
  }
}
$pdo = new PDO('mysql:host=localhost;dbname=gvac', 'agustin', 'tuvieja');
?>