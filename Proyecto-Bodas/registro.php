<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptamos la contraseña
    $tipo_cuenta = $conn->real_escape_string($_POST['tipo_cuenta']);
    
    // Verificar si el correo ya existe
    $check_email = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");
    
    if ($check_email->num_rows > 0) {
        $response = [
            'status' => 'error',
            'message' => 'Este correo electrónico ya está registrado'
        ];
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, password, tipo_cuenta) VALUES ('$nombre', '$email', '$password', '$tipo_cuenta')";
        
        if ($conn->query($sql) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Registro exitoso. ¡Ahora puedes iniciar sesión!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error al registrar: ' . $conn->error
            ];
        }
    }
    
    echo json_encode($response);
    exit;
}
?>
