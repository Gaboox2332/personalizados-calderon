<?php
include 'db.php'; // Incluye la conexión a la base de datos

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];

    try {
        // Verifica si ya existe un registro con el mismo nombre, correo o teléfono
        $stmt = $pdo->prepare("SELECT * FROM participantes WHERE nombre = :nombre OR correo = :correo OR whatsapp = :whatsapp");
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':whatsapp' => $whatsapp,
        ]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Si ya existe, muestra un mensaje personalizado
            echo "Error: El nombre, correo o número de WhatsApp ya están registrados.";
        } else {
            // Inserta los datos en la tabla
            $stmt = $pdo->prepare("INSERT INTO participantes (nombre, correo, whatsapp) VALUES (:nombre, :correo, :whatsapp)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':whatsapp' => $whatsapp,
            ]);
            // Redirige a una página de éxito
            header("Location: registro_exitoso.html");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
