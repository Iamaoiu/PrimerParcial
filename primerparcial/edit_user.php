<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require 'config.php';

$id = $_GET['id'];
// De aquí se obtienen los datos del usuario actual
$sql = "SELECT username, gmail, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Actualización de los datos del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $gmail = $_POST['gmail'];
    $role = $_POST['role'];

    $update_sql = "UPDATE users SET username = ?, gmail = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $username, $gmail, $role, $id);

    if ($stmt->execute()) {
        header("Location: dashboard_admin.php");
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
