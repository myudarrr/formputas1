<?php
$page_title = 'Data Murid';
$active_page = 'students';
require_once 'header.php';
require_once 'db_config.php';

// --- LOGIKA PENCARIAN ---
$search_query = $_GET['search'] ?? '';
$search_term = "%" . $search_query . "%";

// --- LOGIKA PAGINASI ---
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// --- MENGHITUNG TOTAL DATA UNTUK PAGINASI ---
$count_sql = "SELECT COUNT(id) as total FROM students";
if (!empty($search_query)) {
    $count_sql .= " WHERE nama_lengkap LIKE ? OR email_murid LIKE ? OR telepon_murid LIKE ?";
}
$stmt_count = $conn->prepare($count_sql);
if (!empty($search_query)) {
    $stmt_count->bind_param("sss", $search_term, $search_term, $search_term);
}
$stmt_count->execute();
$total_results = $stmt_count->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_results / $limit);
$stmt_count->close();


// --- MENGAMBIL DATA MURID DENGAN PENCARIAN DAN PAGINASI ---
$sql = "SELECT id, nama_lengkap, email_murid, telepon_murid, tanggal_pendaftaran FROM students";
if (!empty($search_query)) {
    $sql .= " WHERE nama_lengkap LIKE ? OR email_murid LIKE ? OR telepon_murid LIKE ?";
}
$sql .= " ORDER BY tanggal_pendaftaran DESC LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
if (!empty($search_query)) {
    $stmt->bind_param("sssii", $search_term, $search_term, $search_term, $limit, $offset);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

?>

<?php
// Tampilkan notifikasi jika ada
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = '';
    if ($status == 'added') $message = 'Data murid berhasil ditambahkan!';
    if ($status == 'updated') $message = 'Data murid berhasil diperbarui!';
    if ($status == 'deleted') $message = 'Data murid berhasil dihapus!';
    
    if ($message) {
        echo '<div class="alert alert-success" style="margin-bottom: 20px;">' . htmlspecialchars($message) . '</div>';
    }
}
?>

<div class="card">
    <div class="card-header">
        <h2>Daftar Murid</h2>
    </div>

    <!-- Form Pencarian -->
    <div class="search-container">
        <form action="students.php" method="GET">
            <input type="text" name="search" placeholder="Cari nama, email, atau telepon..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Tgl Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $row_number = $offset + 1; ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row_number++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($row['email_murid']); ?></td>
                        <td><?php echo htmlspecialchars($row['telepon_murid']); ?></td>
                        <td><?php echo date('d M Y', strtotime($row['tanggal_pendaftaran'])); ?></td>
                        <td class="action-btns">
                            <a href="student_view.php?id=<?php echo $row['id']; ?>" class="btn btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                            <a href="student_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="student_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">
                            <?php echo !empty($search_query) ? 'Tidak ada hasil untuk pencarian "' . htmlspecialchars($search_query) . '".' : 'Tidak ada data murid.'; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagianasi -->
    <?php if ($total_pages > 1): ?>
    <div class="pagination-container">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li><a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search_query); ?>">«</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li><a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_query); ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li><a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search_query); ?>">»</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>
</div>

<?php
$stmt->close();
$conn->close();
require_once 'footer.php';
?>
