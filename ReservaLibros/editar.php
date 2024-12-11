<?php
include_once 'config/Database.php';
include_once 'models/Reserva.php';

$database = new Database();
$db = $database->getConnection();

$reserva = new Reserva($db);

if ($_POST) {
    $reserva->id = $_POST['id'];
    $reserva->titulo = $_POST['titulo'];
    $reserva->autor = $_POST['autor'];
    $reserva->fecha_reserva = $_POST['fecha_reserva'];
    $reserva->usuario = $_POST['usuario'];
    $reserva->fecha_entrega = $_POST['fecha_entrega'];

    if ($reserva->update()) {
        header("Location: index.php?mensaje=Reserva actualizada exitosamente");
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar la reserva.',
                background: '#16213e',
                color: '#e94560'
            })
        </script>
        ";
    }
} else {
    $reserva->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado.');
    $reserva->readOne();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Editar Reserva</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $reserva->id; ?>">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del Libro</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $reserva->titulo; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $reserva->autor; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_reserva" class="form-label">Fecha de Reserva</label>
                        <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" value="<?php echo $reserva->fecha_reserva; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $reserva->usuario; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo $reserva->fecha_entrega; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Reserva
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>

