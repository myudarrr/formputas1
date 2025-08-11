<?php
$page_title = 'Edit Admin';
$active_page = 'admins';
require_once 'header.php';
require_once 'db_config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    header("Location: admins.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($password)) {
        $stmt = $conn->prepare("UPDATE admins SET nama_lengkap = ?, username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nama_lengkap, $username, $email, $id);
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admins SET nama_lengkap = ?, username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nama_lengkap, $username, $email, $hashed_password, $id);
    }
    
    if ($stmt->execute()) {
        header("Location: admins.php?status=updated");
        exit();
    } else {
        $error = "Gagal mengupdate admin. Username atau email mungkin sudah ada.";
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT nama_lengkap, username, email FROM admins WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: admins.php");
    exit();
}
$admin = $result->fetch_assoc();
$stmt->close();
?>

<div class="card">
    <div class="card-header">
        <h2>Form Edit Admin</h2>
    </div>
    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="admin_edit.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($admin['nama_lengkap']); ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password">
                <small>Kosongkan jika tidak ingin mengubah password.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="admins.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</div>

<?php
$conn->close();
require_once 'footer.php';
?>
