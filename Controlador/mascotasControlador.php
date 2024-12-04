<?php
require_once '../modelos/mascotas.php';
require_once '../configuracion/conexion.php';

$mascota = new Mascota($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idMascota'])) {
    $mascotas = $mascota->obtener();
    echo json_encode(($mascotas), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idMascota'])) {
    $idMascota = $_GET['idMascota'];
    $mascota = $mascota->buscar($idMascota);
    echo json_encode(($mascota), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['nombre'], $data['tipo'], $data['raza'], $data['cedulaCliente'])) {
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $raza = $data['raza'];
        $cedulaCliente = $data['cedulaCliente'];
        
        $mascota->crear($nombre, $tipo, $raza, $cedulaCliente);
        echo json_encode(['status' => 'success', 'message' => 'Mascota creada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['idMascota'], $data['nombre'], $data['tipo'], $data['raza'], $data['cedulaCliente'])) {
        $idMascota = $data['idMascota'];
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $raza = $data['raza'];
        $cedulaCliente = $data['cedulaCliente'];
        
        $mascota->actualizar($idMascota, $nombre, $tipo, $raza, $cedulaCliente);
        echo json_encode(['status' => 'success', 'message' => 'Mascota actualizada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['idMascota'])) {
        $idMascota = $data['idMascota'];
        
        $mascota->eliminar($idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Mascota eliminada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de mascota faltante.']);
    }
}
?>
