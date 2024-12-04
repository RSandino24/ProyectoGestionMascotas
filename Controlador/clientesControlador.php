<?php
require_once '../modelos/clientes.php';
require_once '../configuracion/conexion.php';

$cliente = new Cliente($pdo);

$op = isset($_GET['op']) ? $_GET['op'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $op == 'listar') {
    $clientes = $cliente->obtener();
    echo json_encode(($clientes), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];
    $cliente = $cliente->buscar($cedula);
    echo json_encode(($cliente), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $op == 'crear') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['cedula'], $data['nombre'], $data['direccion'], $data['telefono'], $data['email'])) {
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        
        $cliente->crear($cedula, $nombre, $direccion, $telefono, $email);
        echo json_encode(['status' => 'success', 'message' => 'Cliente creado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $op == 'actualizar') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['cedula'], $data['nombre'], $data['direccion'], $data['telefono'], $data['email'])) {
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        
        $cliente->actualizar($cedula, $nombre, $direccion, $telefono, $email);
        echo json_encode(['status' => 'success', 'message' => 'Cliente actualizado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $op == 'eliminar') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['cedula'])) {
        $cedula = $data['cedula'];
        
        $cliente->eliminar($cedula);
        echo json_encode(['status' => 'success', 'message' => 'Cliente eliminado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Cédula de cliente faltante.']);
    }
}
?>
