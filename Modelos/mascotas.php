<?php
class Mascota {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($nombre, $tipo, $raza, $cedulaCliente) {
        $sql = "INSERT INTO mascotas (nombre, tipo, raza, cedulaCliente) VALUES (:nombre, :tipo, :raza, :cedulaCliente)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':raza', $raza);
        $stmt->bindParam(':cedulaCliente', $cedulaCliente);
        $stmt->execute();
    }

    public function actualizar($idMascota, $nombre, $tipo, $raza, $cedulaCliente) {
        $sql = "UPDATE mascotas SET nombre = :nombre, tipo = :tipo, raza = :raza, cedulaCliente = :cedulaCliente WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':raza', $raza);
        $stmt->bindParam(':cedulaCliente', $cedulaCliente);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
    }

    public function eliminar($idMascota) {
        $sql = "DELETE FROM mascotas WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
    }

    public function obtener() {
        $sql = "SELECT * FROM mascotas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($idMascota) {
        $sql = "SELECT * FROM mascotas WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
