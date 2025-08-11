<?php
$page_title = 'Tambah Admin';
$active_page = 'admins';
require_once 'header.php';
require_once 'db_config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $error = "Konfirmasi password tidak cocok.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO admins (nama_lengkap, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama_lengkap, $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            header("Location: admins.php?status=added");
            exit();
        } else {
            $error = "Gagal menambahkan admin. Username atau email mungkin sudah ada.";
        }
        $stmt->close();
    }
}
?>

<div class="card">
    <div class="card-header">
        <h2>Form Tambah Admin Baru</h2>
    </div>
    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="admin_add.php" method="post">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Konfirmasi Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="admins.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</div>

<?php
$conn->close();
require_once 'footer.php';
?>
