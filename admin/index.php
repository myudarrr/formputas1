<?php
$page_title = 'Dashboard';
$active_page = 'dashboard';
require_once 'header.php';
require_once 'db_config.php';

// Get stats
$total_students = $conn->query("SELECT COUNT(id) as count FROM students")->fetch_assoc()['count'];
$total_admins = $conn->query("SELECT COUNT(id) as count FROM admins")->fetch_assoc()['count'];
$new_students_this_month = $conn->query("SELECT COUNT(id) as count FROM students WHERE MONTH(tanggal_pendaftaran) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_pendaftaran) = YEAR(CURRENT_DATE())")->fetch_assoc()['count'];

?>

<div class="card">
    <h2>Selamat Datang di Admin Panel</h2>
    <p>Gunakan menu di samping untuk mengelola data murid dan admin.</p>
</div>

<div class="form-row">
    <div class="form-group">
        <div class="card">
            <h3>Total Murid</h3>
            <p style="font-size: 2rem; font-weight: bold; color: var(--primary-color);"><?php echo $total_students; ?></p>
        </div>
    </div>
    <div class="form-group">
        <div class="card">
            <h3>Total Admin</h3>
            <p style="font-size: 2rem; font-weight: bold; color: var(--primary-color);"><?php echo $total_admins; ?></p>
        </div>
    </div>
    <div class="form-group">
        <div class="card">
            <h3>Pendaftar Bulan Ini</h3>
            <p style="font-size: 2rem; font-weight: bold; color: var(--primary-color);"><?php echo $new_students_this_month; ?></p>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>
