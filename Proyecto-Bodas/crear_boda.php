<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario_id'])) {
        $response = [
            'status' => 'error',
            'message' => 'Debes iniciar sesión para crear una página de boda',
            'redirect' => '#login-modal'
        ];
        echo json_encode($response);
        exit;
    }
    
    $usuario_id = $_SESSION['usuario_id'];
    $nombres_pareja = $conn->real_escape_string($_POST['nombres_pareja']);
    $fecha_boda = $conn->real_escape_string($_POST['fecha_boda']);
    $lugar_ceremonia = $conn->real_escape_string($_POST['lugar_ceremonia']);
    $tema = $conn->real_escape_string($_POST['tema']);
    
    // Insertar nueva boda
    $sql = "INSERT INTO bodas (usuario_id, nombres_pareja, fecha_boda, lugar_ceremonia, tema) 
            VALUES ('$usuario_id', '$nombres_pareja', '$fecha_boda', '$lugar_ceremonia', '$tema')";
    
    if ($conn->query($sql) === TRUE) {
        $boda_id = $conn->insert_id;
        $response = [
            'status' => 'success',
            'message' => '¡Tu página de boda ha sido creada exitosamente!',
            'redirect' => 'mi_boda.php?id=' . $boda_id
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al crear la página de boda: ' . $conn->error
        ];
    }
    
    echo json_encode($response);
    exit;
}
?>
