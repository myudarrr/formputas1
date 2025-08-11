<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anastasya Vocal Arts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="logo-ava.png">
</head>
<body>
    <div class="background-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
        <div class="shape shape4"></div>
        <div class="shape shape5"></div>
        <div class="shape shape6"></div>
    </div>

    <div class="form-container">
        <form id="regForm" action="process_form.php" method="post" enctype="multipart/form-data" novalidate>
            <header>
                <h2>Anastasya Vocal Arts</h2>
                <p>Formulir Pendaftaran</p>
                <div class="progress-bar">
                    <div class="progress-step active" data-title="Data Diri"></div>
                    <div class="progress-step" data-title="Data Wali"></div>
                    <div class="progress-step" data-title="Minat Musik"></div>
                    <div class="progress-step" data-title="Lainnya"></div>
                </div>
            </header>

            <!-- Step 1: Data Diri Murid -->
            <div class="form-step active">
                <h2 class="step-title">Data Diri </h2>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap Anda" required>
                </div>
                <div class="form-group">
                    <label for="nama_panggilan">Nama Panggilan</label>
                    <input type="text" id="nama_panggilan" name="nama_panggilan" placeholder="Masukkan nama panggilan">
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Kota kelahiran" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat_lengkap">Alamat Lengkap</label>
                    <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="RT/RW, Kelurahan, Kecamatan, Kota/Kab" required></textarea>
                </div>
                 <div class="form-group">
                    <label for="telepon_murid">Nomor Telepon/WhatsApp</label>
                    <input type="tel" id="telepon_murid" name="telepon_murid" placeholder="Contoh: 08123456789" required>
                </div>
                <div class="form-group">
                    <label for="email_murid">Email</label>
                    <input type="email" id="email_murid" name="email_murid" placeholder="Contoh: email@anda.com" required>
                </div>
            </div>

            <!-- Step 2: Data Orang Tua/Wali -->
            <div class="form-step">
                <h2 class="step-title">Data Orang Tua/Wali (Opsional)</h2>
                <div class="form-group">
                    <label for="nama_orang_tua">Nama Orang Tua/Wali</label>
                    <input type="text" id="nama_orang_tua" name="nama_orang_tua" placeholder="Masukkan nama orang tua/wali">
                </div>
                <div class="form-group">
                    <label for="pekerjaan_orang_tua">Pekerjaan Orang Tua/Wali</label>
                    <input type="text" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua" placeholder="Masukkan pekerjaan">
                </div>
                <div class="form-group">
                    <label for="telepon_orang_tua">Nomor Telepon/WhatsApp Orang Tua/Wali</label>
                    <input type="tel" id="telepon_orang_tua" name="telepon_orang_tua" placeholder="Contoh: 08123456789">
                </div>
                <div class="form-group">
                    <label for="email_orang_tua">Email Orang Tua/Wali</label>
                    <input type="email" id="email_orang_tua" name="email_orang_tua" placeholder="Contoh: email@orangtua.com">
                </div>
            </div>

            <!-- Step 3: Latar Belakang & Minat Musik -->
            <div class="form-step">
                <h2 class="step-title">Latar Belakang & Minat Musik</h2>
                <div class="form-group">
                    <label for="pendidikan_terakhir">Pendidikan/Asal Sekolah</label>
                    <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Contoh: SMA Negeri 1 Jakarta" required>
                </div>
                <div class="form-group">
                    <label for="kelas_semester">Kelas/Semester</label>
                    <input type="text" id="kelas_semester" name="kelas_semester" placeholder="Contoh: Kelas 12 / Semester 1">
                </div>
                <div class="form-group">
                    <label for="hobi_minat">Hobi & Minat</label>
                    <textarea id="hobi_minat" name="hobi_minat" rows="2" placeholder="Sebutkan hobi dan minat Anda"></textarea>
                </div>
                <div class="form-group">
                    <label for="pengalaman_musik">Pengalaman Bermusik/Les/Menyanyi Sebelumnya</label>
                    <textarea id="pengalaman_musik" name="pengalaman_musik" rows="2" placeholder="Jelaskan pengalaman Anda (jika ada)"></textarea>
                </div>
                <div class="form-group">
                    <label for="genre_favorit">Genre/Lagu Favorit</label>
                    <input type="text" id="genre_favorit" name="genre_favorit" placeholder="Contoh: Pop, Jazz / Lagu oleh Raisa">
                </div>
                 <div class="form-group">
                    <label>Pernah Ikut Lomba/Pentas Musik?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="pernah_lomba" value="Ya" required> Ya</label>
                        <label><input type="radio" name="pernah_lomba" value="Tidak"> Tidak</label>
                    </div>
                </div>
                <div class="form-group" id="detail_lomba_group" style="display: none;">
                    <label for="detail_lomba">Sebutkan Lomba/Pentas</label>
                    <textarea id="detail_lomba" name="detail_lomba" rows="2" placeholder="Sebutkan nama acara, tahun, dan pencapaian"></textarea>
                </div>
            </div>

            <!-- Step 4: Tujuan & Kesehatan -->
            <div class="form-step">
                <h2 class="step-title">Tujuan, Kesehatan & Foto</h2>
                <div class="form-group">
                    <label for="motivasi_harapan">Motivasi & Harapan Mengikuti Les Vokal</label>
                    <textarea id="motivasi_harapan" name="motivasi_harapan" rows="3" placeholder="Apa yang memotivasi Anda dan apa harapan Anda?" required></textarea>
                </div>
                <div class="form-group">
                    <label for="referensi_lagu">Referensi Lagu yang Ingin Dipelajari</label>
                    <textarea id="referensi_lagu" name="referensi_lagu" rows="2" placeholder="Sebutkan beberapa judul lagu"></textarea>
                </div>
                <div class="form-group">
                    <label for="riwayat_kesehatan">Riwayat Kesehatan</label>
                    <textarea id="riwayat_kesehatan" name="riwayat_kesehatan" rows="2" placeholder="Misal: alergi debu, asma. Isi 'Tidak Ada' jika tidak ada."></textarea>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Terbaru</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required>
                    <small>Unggah foto formal atau semi-formal terbaru Anda (maks. 2MB).</small>
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn btn-prev">Sebelumnya</button>
                <button type="button" class="btn btn-next">Selanjutnya</button>
                <button type="submit" class="btn btn-submit">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prevBtn = document.querySelector('.btn-prev');
            const nextBtn = document.querySelector('.btn-next');
            const submitBtn = document.querySelector('.btn-submit');
            const formSteps = Array.from(document.querySelectorAll('.form-step'));
            const progressSteps = Array.from(document.querySelectorAll('.progress-step'));
            const form = document.getElementById('regForm');

            let currentStep = 0;

            nextBtn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    if (currentStep < formSteps.length - 1) {
                        currentStep++;
                        updateFormSteps();
                    }
                } else {
                    alert('Harap lengkapi semua kolom yang wajib diisi pada langkah ini.');
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateFormSteps();
                }
            });
            
            form.addEventListener('submit', (e) => {
                if (!validateStep(currentStep)) {
                    e.preventDefault();
                    alert('Harap lengkapi semua kolom yang wajib diisi dan unggah foto Anda.');
                }
            });

            function updateFormSteps() {
                formSteps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });
                progressSteps.forEach((step, index) => {
                    step.classList.toggle('active', index <= currentStep);
                });
                updateButtons();
            }

            function updateButtons() {
                prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
                nextBtn.style.display = currentStep < formSteps.length - 1 ? 'inline-block' : 'none';
                submitBtn.style.display = currentStep === formSteps.length - 1 ? 'inline-block' : 'none';
            }
            
            function validateStep(stepIndex) {
                let isValid = true;
                const currentStepFields = formSteps[stepIndex].querySelectorAll('[required]');
                currentStepFields.forEach(field => {
                    field.parentElement.classList.remove('error');
                    let fieldValid = true;

                    if (field.type === 'radio') {
                        const radioGroup = document.querySelector(`input[name="${field.name}"]:checked`);
                        if (!radioGroup) {
                            fieldValid = false;
                            field.closest('.radio-group').parentElement.classList.add('error');
                        }
                    } else if (field.type === 'file') {
                        if (field.files.length === 0) {
                           fieldValid = false;
                        }
                    } else if (!field.value.trim()) {
                        fieldValid = false;
                    }

                    if(!fieldValid) {
                        isValid = false;
                        field.parentElement.classList.add('error');
                    }
                });
                return isValid;
            }

            // Logic for conditional field
            const lombaRadios = document.querySelectorAll('input[name="pernah_lomba"]');
            const detailLombaGroup = document.getElementById('detail_lomba_group');
            lombaRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'Ya') {
                        detailLombaGroup.style.display = 'block';
                        detailLombaGroup.querySelector('textarea').setAttribute('required', 'required');
                    } else {
                        detailLombaGroup.style.display = 'none';
                        detailLombaGroup.querySelector('textarea').removeAttribute('required');
                        detailLombaGroup.parentElement.classList.remove('error');
                    }
                });
            });

            updateButtons();
        });
    </script>
</body>
</html>
