<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($cedula, $nombre, $direccion, $telefono, $email) {
        $sql = "INSERT INTO clientes (cedula, nombre, direccion, telefono, email) VALUES (:cedula, :nombre, :direccion, :telefono, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public function actualizar($cedula, $nombre, $direccion, $telefono, $email) {
        $sql = "UPDATE clientes SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public function eliminar($cedula) {
        $sql = "DELETE FROM clientes WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
    }

    public function obtener() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($cedula) {
        $sql = "SELECT * FROM clientes WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
