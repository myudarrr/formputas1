<?php
require_once 'db_config.php';

// Fungsi untuk membersihkan input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Cek apakah request method adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil dan bersihkan data dari form
    $nama_lengkap = clean_input($_POST['nama_lengkap']);
    $nama_panggilan = clean_input($_POST['nama_panggilan']);
    $tempat_lahir = clean_input($_POST['tempat_lahir']);
    $tanggal_lahir = clean_input($_POST['tanggal_lahir']);
    $jenis_kelamin = clean_input($_POST['jenis_kelamin']);
    $alamat_lengkap = clean_input($_POST['alamat_lengkap']);
    $telepon_murid = clean_input($_POST['telepon_murid']);
    $email_murid = clean_input($_POST['email_murid']);
    $nama_orang_tua = clean_input($_POST['nama_orang_tua']);
    $pekerjaan_orang_tua = clean_input($_POST['pekerjaan_orang_tua']);
    $telepon_orang_tua = clean_input($_POST['telepon_orang_tua']);
    $email_orang_tua = clean_input($_POST['email_orang_tua']);
    $pendidikan_terakhir = clean_input($_POST['pendidikan_terakhir']);
    $kelas_semester = clean_input($_POST['kelas_semester']);
    $hobi_minat = clean_input($_POST['hobi_minat']);
    $pengalaman_musik = clean_input($_POST['pengalaman_musik']);
    $genre_favorit = clean_input($_POST['genre_favorit']);
    $pernah_lomba = clean_input($_POST['pernah_lomba']);
    $detail_lomba = ($pernah_lomba == 'Ya') ? clean_input($_POST['detail_lomba']) : NULL;
    $motivasi_harapan = clean_input($_POST['motivasi_harapan']);
    $referensi_lagu = clean_input($_POST['referensi_lagu']);
    $riwayat_kesehatan = clean_input($_POST['riwayat_kesehatan']);

    // Proses upload foto
    $foto_path = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_extension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $safe_filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($_FILES["foto"]["name"], PATHINFO_FILENAME));
        $target_file = $target_dir . uniqid() . '_' . $safe_filename . '.' . $file_extension;
        
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $foto_path = $target_file;
            } else {
                die("Error: Gagal mengunggah file.");
            }
        } else {
            die("Error: File yang diunggah bukan gambar.");
        }
    } else {
        die("Error: Foto wajib diunggah.");
    }

    // Siapkan statement SQL
    $stmt = $conn->prepare("INSERT INTO students (nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat_lengkap, telepon_murid, email_murid, nama_orang_tua, pekerjaan_orang_tua, telepon_orang_tua, email_orang_tua, pendidikan_terakhir, kelas_semester, hobi_minat, pengalaman_musik, genre_favorit, pernah_lomba, detail_lomba, motivasi_harapan, referensi_lagu, riwayat_kesehatan, foto_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssssssssssssssssssssss", 
        $nama_lengkap, $nama_panggilan, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat_lengkap, $telepon_murid, $email_murid, 
        $nama_orang_tua, $pekerjaan_orang_tua, $telepon_orang_tua, $email_orang_tua, 
        $pendidikan_terakhir, $kelas_semester, $hobi_minat, $pengalaman_musik, $genre_favorit, 
        $pernah_lomba, $detail_lomba, $motivasi_harapan, $referensi_lagu, $riwayat_kesehatan, $foto_path
    );

    // Eksekusi statement
    if ($stmt->execute()) {
        // Data berhasil disimpan, sekarang siapkan pesan WhatsApp

        // --- PENTING: GANTI NOMOR INI DENGAN NOMOR WHATSAPP TUJUAN ANDA ---
        $whatsapp_number = "628112233439"; // Format: kode negara + nomor (tanpa +)

        // Buat pesan WhatsApp
        $message = "Halo Anastasya Vocal Arts,\n\nSaya telah mendaftar dengan detail sebagai berikut:\n\n";
        $message .= "*Nama Lengkap:* " . $nama_lengkap . "\n";
        $message .= "*Nama Panggilan:* " . $nama_panggilan . "\n";
        $message .= "*Tanggal Lahir:* " . date("d F Y", strtotime($tanggal_lahir)) . "\n";
        $message .= "*No. Telepon:* " . $telepon_murid . "\n";
        $message .= "*Email:* " . $email_murid . "\n";
        $message .= "*Nama Wali:* " . $nama_orang_tua . "\n";
        $message .= "*No. Telepon Wali:* " . $telepon_orang_tua . "\n\n";
        $message .= "*Motivasi & Harapan:*\n" . $motivasi_harapan . "\n\n";
        $message .= "Mohon untuk segera ditindaklanjuti. Terima kasih.";

        // Encode pesan untuk URL
        $encoded_message = urlencode($message);

        // Buat URL WhatsApp
        $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . $encoded_message;

        // Redirect ke WhatsApp
        header("Location: " . $whatsapp_url);
        exit();

    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

} else {
    // Jika bukan POST, redirect ke form
    header("Location: index.php");
    exit();
}
?>
