<?php
include_once 'config/Database.php';
include_once 'models/Cultivo.php';

$database = new Database();
$db = $database->getConnection();

$cultivo = new Cultivo($db);

if (isset($_GET['id'])) {
    $cultivo->id = $_GET['id'];
    
    if ($cultivo->delete()) {
        header("Location: index.php?mensaje=Cultivo eliminado exitosamente");
    } else {
        header("Location: index.php?mensaje=No se pudo eliminar el cultivo");
    }
} else {
    header("Location: index.php?mensaje=ID no especificado");
}
?>

