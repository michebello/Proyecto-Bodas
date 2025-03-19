<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Inicio de sesión exitoso
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['tipo_cuenta'] = $row['tipo_cuenta'];
            
            $response = [
                'status' => 'success',
                'message' => '¡Inicio de sesión exitoso!',
                'redirect' => 'index.php'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Contraseña incorrecta'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No existe una cuenta con este correo electrónico'
        ];
    }
    
    echo json_encode($response);
    exit;
}
?>
