<?php
$host = 'tcp:servermascotas.database.windows.net,1433';
$dbname = 'dbmascotas';
$username = 'adminronny';
$password = 'Patos123**'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
