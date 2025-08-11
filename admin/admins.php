<?php
$page_title = 'Data Admin';
$active_page = 'admins';
require_once 'header.php';
require_once 'db_config.php';

$result = $conn->query("SELECT id, nama_lengkap, username, email, created_at FROM admins ORDER BY created_at DESC");
?>

<div class="card">
    <div class="card-header">
        <h2>Daftar Admin</h2>
        <a href="admin_add.php" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Admin</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tgl Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                        <td class="action-btns">
                            <a href="admin_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                            <?php if ($row['id'] != $_SESSION['admin_id']): // Admin tidak bisa hapus diri sendiri ?>
                            <a href="admin_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')"><i class="fas fa-trash"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Tidak ada data admin.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
require_once 'footer.php';
?>
