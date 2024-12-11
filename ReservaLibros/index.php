<?php
include_once 'config/Database.php';
include_once 'models/Reserva.php';

$database = new Database();
$db = $database->getConnection();

$reserva = new Reserva($db);
$stmt = $reserva->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Sistema de Reservas de Libros</h2>
                <a href="crear.php" class="btn btn-primary mb-3">
                    <i class="fas fa-plus-circle"></i> Nueva Reserva
                </a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Fecha de Reserva</th>
                                <th>Usuario</th>
                                <th>Fecha de Entrega</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo "<tr>
                                    <td>{$id}</td>
                                    <td>{$titulo}</td>
                                    <td>{$autor}</td>
                                    <td>{$fecha_reserva}</td>
                                    <td>{$usuario}</td>
                                    <td>{$fecha_entrega}</td>
                                    <td>
                                        <a href='editar.php?id={$id}' class='btn btn-primary btn-sm'>
                                            <i class='fas fa-edit'></i> Editar
                                        </a>
                                        <a href='#' onclick='confirmarEliminar({$id})' class='btn btn-danger btn-sm'>
                                            <i class='fas fa-trash-alt'></i> Eliminar
                                        </a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f3460',
            cancelButtonColor: '#e94560',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'eliminar.php?id=' + id;
            }
        })
    }
    </script>
    <?php
    if (isset($_GET['mensaje'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '" . $_GET['mensaje'] . "',
                background: '#16213e',
                color: '#e94560'
            })
        </script>
        ";
    }
    ?>
</body>
</html>

