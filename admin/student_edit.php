<?php
$page_title = 'Edit Murid';
$active_page = 'students';
require_once 'header.php';
require_once 'db_config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    header("Location: students.php");
    exit();
}

$error = '';
$success = '';

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil semua data dari form
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nama_panggilan = $_POST['nama_panggilan'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $alamat_lengkap = $_POST['alamat_lengkap'] ?? '';
    $telepon_murid = $_POST['telepon_murid'] ?? '';
    $email_murid = $_POST['email_murid'] ?? '';
    $nama_orang_tua = $_POST['nama_orang_tua'] ?? '';
    $pekerjaan_orang_tua = $_POST['pekerjaan_orang_tua'] ?? '';
    $telepon_orang_tua = $_POST['telepon_orang_tua'] ?? '';
    $email_orang_tua = $_POST['email_orang_tua'] ?? '';
    $pendidikan_terakhir = $_POST['pendidikan_terakhir'] ?? '';
    $kelas_semester = $_POST['kelas_semester'] ?? '';
    $hobi_minat = $_POST['hobi_minat'] ?? '';
    $pengalaman_musik = $_POST['pengalaman_musik'] ?? '';
    $genre_favorit = $_POST['genre_favorit'] ?? '';
    $pernah_lomba = $_POST['pernah_lomba'] ?? '';
    $detail_lomba = $_POST['detail_lomba'] ?? '';
    $motivasi_harapan = $_POST['motivasi_harapan'] ?? '';
    $referensi_lagu = $_POST['referensi_lagu'] ?? '';
    $riwayat_kesehatan = $_POST['riwayat_kesehatan'] ?? '';
    $foto_path = $_POST['current_foto_path'] ?? null;

    // Proses upload foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        // Hapus foto lama jika ada dan bukan foto default
        if (!empty($foto_path) && file_exists('../' . $foto_path)) {
            unlink('../' . $foto_path);
        }

        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_name = uniqid() . '-' . basename($_FILES['foto']['name']);
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $foto_path = 'uploads/' . $file_name;
        } else {
            $error = "Gagal mengupload foto baru.";
        }
    }

    if (empty($error)) {
        $stmt = $conn->prepare("UPDATE students SET 
            nama_lengkap = ?, nama_panggilan = ?, tempat_lahir = ?, tanggal_lahir = ?, 
            jenis_kelamin = ?, alamat_lengkap = ?, telepon_murid = ?, email_murid = ?, 
            nama_orang_tua = ?, pekerjaan_orang_tua = ?, telepon_orang_tua = ?, email_orang_tua = ?, 
            pendidikan_terakhir = ?, kelas_semester = ?, hobi_minat = ?, pengalaman_musik = ?, 
            genre_favorit = ?, pernah_lomba = ?, detail_lomba = ?, motivasi_harapan = ?, 
            referensi_lagu = ?, riwayat_kesehatan = ?, foto_path = ? 
            WHERE id = ?");
        
        $stmt->bind_param("sssssssssssssssssssssssi", 
            $nama_lengkap, $nama_panggilan, $tempat_lahir, $tanggal_lahir, 
            $jenis_kelamin, $alamat_lengkap, $telepon_murid, $email_murid, 
            $nama_orang_tua, $pekerjaan_orang_tua, $telepon_orang_tua, $email_orang_tua, 
            $pendidikan_terakhir, $kelas_semester, $hobi_minat, $pengalaman_musik, 
            $genre_favorit, $pernah_lomba, $detail_lomba, $motivasi_harapan, 
            $referensi_lagu, $riwayat_kesehatan, $foto_path, $id);
        
        if ($stmt->execute()) {
            header("Location: students.php?status=updated");
            exit();
        } else {
            $error = "Gagal mengupdate data: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Ambil data murid saat ini untuk ditampilkan di form
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
$conn->close();
?>

<div class="card">
    <div class="card-header">
        <h2>Form Edit Murid: <?php echo htmlspecialchars($student['nama_lengkap']); ?></h2>
    </div>
    <div class="form-container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="student_edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="current_foto_path" value="<?php echo htmlspecialchars($student['foto_path']); ?>">
            
            <h3>Data Diri Murid</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($student['nama_lengkap']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_panggilan">Nama Panggilan</label>
                    <input type="text" id="nama_panggilan" name="nama_panggilan" value="<?php echo htmlspecialchars($student['nama_panggilan']); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($student['tempat_lahir']); ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($student['tanggal_lahir']); ?>">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin">
                        <option value="Laki-laki" <?php echo ($student['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo ($student['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat_lengkap">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3"><?php echo htmlspecialchars($student['alamat_lengkap']); ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="telepon_murid">Telepon Murid</label>
                    <input type="tel" id="telepon_murid" name="telepon_murid" value="<?php echo htmlspecialchars($student['telepon_murid']); ?>">
                </div>
                <div class="form-group">
                    <label for="email_murid">Email Murid</label>
                    <input type="email" id="email_murid" name="email_murid" value="<?php echo htmlspecialchars($student['email_murid']); ?>">
                </div>
            </div>

            <hr>
            <h3>Data Orang Tua/Wali</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_orang_tua">Nama Orang Tua/Wali</label>
                    <input type="text" id="nama_orang_tua" name="nama_orang_tua" value="<?php echo htmlspecialchars($student['nama_orang_tua']); ?>">
                </div>
                <div class="form-group">
                    <label for="pekerjaan_orang_tua">Pekerjaan Orang Tua/Wali</label>
                    <input type="text" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua" value="<?php echo htmlspecialchars($student['pekerjaan_orang_tua']); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="telepon_orang_tua">Telepon Orang Tua/Wali</label>
                    <input type="tel" id="telepon_orang_tua" name="telepon_orang_tua" value="<?php echo htmlspecialchars($student['telepon_orang_tua']); ?>">
                </div>
                <div class="form-group">
                    <label for="email_orang_tua">Email Orang Tua/Wali</label>
                    <input type="email" id="email_orang_tua" name="email_orang_tua" value="<?php echo htmlspecialchars($student['email_orang_tua']); ?>">
                </div>
            </div>

            <hr>
            <h3>Latar Belakang & Minat</h3>
             <div class="form-row">
                <div class="form-group">
                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                    <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" value="<?php echo htmlspecialchars($student['pendidikan_terakhir']); ?>">
                </div>
                <div class="form-group">
                    <label for="kelas_semester">Kelas/Semester Saat Ini</label>
                    <input type="text" id="kelas_semester" name="kelas_semester" value="<?php echo htmlspecialchars($student['kelas_semester']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="hobi_minat">Hobi & Minat</label>
                <textarea id="hobi_minat" name="hobi_minat" rows="3"><?php echo htmlspecialchars($student['hobi_minat']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="pengalaman_musik">Pengalaman di Bidang Musik</label>
                <textarea id="pengalaman_musik" name="pengalaman_musik" rows="3"><?php echo htmlspecialchars($student['pengalaman_musik']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="genre_favorit">Genre Musik Favorit</label>
                <input type="text" id="genre_favorit" name="genre_favorit" value="<?php echo htmlspecialchars($student['genre_favorit']); ?>">
            </div>
            <div class="form-group">
                <label>Pernah Mengikuti Lomba?</label>
                <div class="radio-group">
                    <label><input type="radio" name="pernah_lomba" value="Ya" <?php echo ($student['pernah_lomba'] == 'Ya') ? 'checked' : ''; ?>> Ya</label>
                    <label><input type="radio" name="pernah_lomba" value="Tidak" <?php echo ($student['pernah_lomba'] == 'Tidak') ? 'checked' : ''; ?>> Tidak</label>
                </div>
            </div>
            <div class="form-group">
                <label for="detail_lomba">Jika Ya, sebutkan</label>
                <textarea id="detail_lomba" name="detail_lomba" rows="3"><?php echo htmlspecialchars($student['detail_lomba']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="motivasi_harapan">Motivasi & Harapan</label>
                <textarea id="motivasi_harapan" name="motivasi_harapan" rows="3"><?php echo htmlspecialchars($student['motivasi_harapan']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="referensi_lagu">Referensi Lagu untuk Ujian Masuk</label>
                <textarea id="referensi_lagu" name="referensi_lagu" rows="3"><?php echo htmlspecialchars($student['referensi_lagu']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="riwayat_kesehatan">Riwayat Kesehatan</label>
                <textarea id="riwayat_kesehatan" name="riwayat_kesehatan" rows="3"><?php echo htmlspecialchars($student['riwayat_kesehatan']); ?></textarea>
            </div>

            <hr>
            <h3>Foto Murid</h3>
            <div class="form-group">
                <label>Foto Saat Ini</label>
                <div>
                <?php if (!empty($student['foto_path']) && file_exists('../' . $student['foto_path'])): ?>
                    <img src="../<?php echo htmlspecialchars($student['foto_path']); ?>" alt="Foto Murid" class="student-photo" style="margin-bottom: 10px;">
                <?php else: ?>
                    <p>Tidak ada foto.</p>
                <?php endif; ?>
                </div>
                <label for="foto">Ganti Foto (Opsional)</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Update Data Murid</button>
            <a href="students.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</div>

<?php
require_once 'footer.php';
?>
