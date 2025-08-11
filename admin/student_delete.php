<?php
require_once 'session.php';
require_once 'db_config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    header("Location: students.php");
    exit();
}

// Optional: Hapus file foto jika ada
$stmt = $conn->prepare("SELECT foto_path FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if($row = $result->fetch_assoc()){
    if(!empty($row['foto_path']) && file_exists('../' . $row['foto_path'])){
        unlink('../' . $row['foto_path']);
    }
}
$stmt->close();

// Hapus data dari database
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: students.php?status=deleted");
} else {
    header("Location: students.php?status=error");
}

$stmt->close();
$conn->close();
exit();
?>
