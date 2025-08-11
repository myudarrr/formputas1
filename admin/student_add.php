<?php
$page_title = 'Tambah Murid';
$active_page = 'students';
require_once 'header.php';
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    // ... tambahkan semua field lainnya dari form
    $email_murid = $_POST['email_murid'] ?? '';
    $telepon_murid = $_POST['telepon_murid'] ?? '';

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO students (nama_lengkap, email_murid, telepon_murid) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama_lengkap, $email_murid, $telepon_murid);
    
    if ($stmt->execute()) {
        header("Location: students.php?status=added");
        exit();
    } else {
        $error = "Gagal menambahkan data: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="card">
    <div class="card-header">
        <h2>Form Tambah Murid Baru</h2>
    </div>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="student_add.php" method="post">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email_murid">Email Murid</label>
                    <input type="email" id="email_murid" name="email_murid" required>
                </div>
                <div class="form-group">
                    <label for="telepon_murid">Telepon Murid</label>
                    <input type="tel" id="telepon_murid" name="telepon_murid" required>
                </div>
            </div>
            <!-- Tambahkan field form lainnya sesuai dengan tabel students -->
            <p><em>Catatan: Form ini hanya berisi field dasar. Silakan lengkapi sesuai kebutuhan.</em></p>
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="students.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</div>

<?php
$conn->close();
require_once 'footer.php';
?>
