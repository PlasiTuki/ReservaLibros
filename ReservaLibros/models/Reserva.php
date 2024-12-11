<?php
class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $id;
    public $titulo;
    public $autor;
    public $fecha_reserva;
    public $usuario;
    public $fecha_entrega;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET titulo=:titulo, autor=:autor, fecha_reserva=:fecha_reserva, usuario=:usuario, fecha_entrega=:fecha_entrega";
        $stmt = $this->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->fecha_reserva = htmlspecialchars(strip_tags($this->fecha_reserva));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->fecha_entrega = htmlspecialchars(strip_tags($this->fecha_entrega));

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":fecha_reserva", $this->fecha_reserva);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":fecha_entrega", $this->fecha_entrega);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET titulo=:titulo, autor=:autor, fecha_reserva=:fecha_reserva, usuario=:usuario, fecha_entrega=:fecha_entrega WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->fecha_reserva = htmlspecialchars(strip_tags($this->fecha_reserva));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->fecha_entrega = htmlspecialchars(strip_tags($this->fecha_entrega));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":fecha_reserva", $this->fecha_reserva);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":fecha_entrega", $this->fecha_entrega);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->titulo = $row['titulo'];
        $this->autor = $row['autor'];
        $this->fecha_reserva = $row['fecha_reserva'];
        $this->usuario = $row['usuario'];
        $this->fecha_entrega = $row['fecha_entrega'];
    }
}
?>

