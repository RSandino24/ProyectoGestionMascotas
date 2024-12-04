<?php
require_once '../modelos/citas.php';
require_once '../configuracion/conexion.php';

$cita = new Cita($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idCita'])) {
    $citas = $cita->obtener();
    echo json_encode(($citas), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idCita'])) {
    $idCita = $_GET['idCita'];
    $cita = $cita->buscar($idCita);
    echo json_encode(($cita), JSON_PRETTY_PRINT);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['fecha'], $data['hora'], $data['idMascota'])) {
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $idMascota = $data['idMascota'];
        
        $cita->crear($fecha, $hora, $idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Cita creada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['idCita'], $data['fecha'], $data['hora'], $data['idMascota'])) {
        $idCita = $data['idCita'];
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $idMascota = $data['idMascota'];
        
        $cita->actualizar($idCita, $fecha, $hora, $idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Cita actualizada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['idCita'])) {
        $idCita = $data['idCita'];
        
        $cita->eliminar($idCita);
        echo json_encode(['status' => 'success', 'message' => 'Cita eliminada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de cita faltante.']);
    }
}
?>
