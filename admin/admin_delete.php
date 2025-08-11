<?php
require_once 'session.php';
require_once 'db_config.php';

$id = $_GET['id'] ?? 0;

// Admin tidak bisa menghapus diri sendiri
if ($id == $_SESSION['admin_id']) {
    header("Location: admins.php?status=self_delete_error");
    exit();
}

if ($id == 0) {
    header("Location: admins.php");
    exit();
}

$stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admins.php?status=deleted");
} else {
    header("Location: admins.php?status=error");
}

$stmt->close();
$conn->close();
exit();
?>
