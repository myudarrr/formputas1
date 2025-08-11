<?php
$page_title = 'Detail Murid';
$active_page = 'students';
require_once 'header.php';
require_once 'db_config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    header("Location: students.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: students.php");
    exit();
}
$student = $result->fetch_assoc();
$stmt->close();

// Menentukan path foto. Diasumsikan 'foto_path' menyimpan 'uploads/namafile.jpg'
$photo_display_path = !empty($student['foto_path']) ? '../' . $student['foto_path'] : null;
?>

<div class="card">
    <div class="card-header">
        <h2>Detail Murid: <?php echo htmlspecialchars($student['nama_lengkap']); ?></h2>
        <a href="students.php" class="btn btn-back">Kembali</a>
    </div>
    <div class="form-row">
        <div class="form-group" style="flex: 3;">
            <ul class="view-details">
                <?php foreach ($student as $key => $value): ?>
                    <?php if($key != 'id' && $key != 'foto_path'): // ID tidak ditampilkan ?>
                    <li>
                        <strong><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $key))); ?></strong>
                        <span><?php echo htmlspecialchars($value); ?></span>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group" style="flex: 1; text-align: center;">
            <strong>Foto Murid</strong><br><br>
            <?php if ($photo_display_path && file_exists($photo_display_path)): ?>
                <img src="<?php echo htmlspecialchars($photo_display_path); ?>" alt="Foto Murid" class="student-photo">
            <?php else: ?>
                <p>Foto tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$conn->close();
require_once 'footer.php';
?>
