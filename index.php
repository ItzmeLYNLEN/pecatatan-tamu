<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Form Penjadwalan Tamu</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 30px;
    }

    .container {
      background: #fff;
      max-width: 600px;
      margin: auto;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      color: #444;
    }

    input[type="text"],
    input[type="datetime-local"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    textarea {
      resize: vertical;
    }

    .gender-group {
      margin-top: 8px;
    }

    .gender-group label {
      display: inline-block;
      margin-right: 15px;
    }

    button {
      background-color: #673ab7;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background-color: #5e35b1;
    }

    video {
      display: block;
      margin: 20px auto;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
    }

    .export-link {
      display: block;
      text-align: center;
      margin-top: 30px;
    }

    .export-link a {
      color: #3367d6;
      text-decoration: none;
      font-weight: bold;
    }

    .export-link a:hover {
      text-decoration: underline;
    }
    
    .error {
      color: red;
      font-size: 0.8em;
      margin-top: 5px;
    }
    
    input.error-field, textarea.error-field {
      border-color: red;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Form Penjadwalan Tamu</h2>

    <form id="multiStepForm" action="proses_simpan.php" method="POST" enctype="multipart/form-data">
      <!-- Step 1 -->
      <div class="step active">
        <label>Nama</label>
        <input type="text" name="nama" required>
        <div id="nama-error" class="error"></div>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>
        <div id="alamat-error" class="error"></div>

        <label>No Telp</label>
        <input type="text" name="no_telp" required>
        <div id="no_telp-error" class="error"></div>

        <label>Gender</label>
        <div class="gender-group">
          <label><input type="radio" name="gender" value="L" required> Laki-laki</label>
          <label><input type="radio" name="gender" value="P"> Perempuan</label>
        </div>
        <div id="gender-error" class="error"></div>

        <label>Upload Foto KTP</label>
        <input type="file" name="foto_ktp" accept="image/*" required>
        <div id="foto_ktp-error" class="error"></div>

        <div class="btn-group">
          <span></span>
          <button type="button" onclick="validateStep1()">Selanjutnya</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <label>Bertemu dengan</label>
        <input type="text" name="bertemu_dengan" required>
        <div id="bertemu_dengan-error" class="error"></div>

        <label>Tanggal & Waktu</label>
        <input type="datetime-local" name="tanggal_jam" required>
        <div id="tanggal_jam-error" class="error"></div>

        <label>Keperluan</label>
        <textarea name="keperluan" required></textarea>
        <div id="keperluan-error" class="error"></div>

        <div class="btn-group">
          <button type="button" onclick="prevStep()">Sebelumnya</button>
          <button type="button" onclick="validateStep2()">Selanjutnya</button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step">
        <label>Video Informasi</label>
        <div style="text-align:center">
          <iframe width="100%" height="315"
            src="https://www.youtube.com/embed/ND6WQTsfCCg"
            title="Video Penjelasan"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>

        <label>Jawaban Pertanyaan dari Video</label>
        <textarea name="jawaban_video" required></textarea>
        <div id="jawaban_video-error" class="error"></div>

        <div class="btn-group">
          <button type="button" onclick="prevStep()">Sebelumnya</button>
          <button type="submit">Simpan</button>
        </div>
      </div>
    </form>

    <div class="export-link">
      <a href="export_excel.php" target="_blank">📥 Export ke Excel</a>
    </div>
  </div>

  <script>
    let currentStep = 0;
    const steps = document.querySelectorAll(".step");

    function showStep(n) {
      steps.forEach((step, i) => step.classList.toggle("active", i === n));
    }

    function nextStep() {
      if (currentStep < steps.length - 1) currentStep++;
      showStep(currentStep);
    }

    function prevStep() {
      if (currentStep > 0) currentStep--;
      showStep(currentStep);
    }
    
    function resetErrors() {
      document.querySelectorAll('.error').forEach(el => {
        el.textContent = '';
      });
      document.querySelectorAll('input, textarea').forEach(el => {
        el.classList.remove('error-field');
      });
    }
    
    function validateStep1() {
      resetErrors();
      let isValid = true;
      
      // Validasi Nama
      const nama = document.querySelector('input[name="nama"]');
      if (!nama.value.trim()) {
        document.getElementById('nama-error').textContent = 'Nama harus diisi';
        nama.classList.add('error-field');
        isValid = false;
      }
      
      // Validasi Alamat
      const alamat = document.querySelector('textarea[name="alamat"]');
      if (!alamat.value.trim()) {
        document.getElementById('alamat-error').textContent = 'Alamat harus diisi';
        alamat.classList.add('error-field');
        isValid = false;
      }
      
      // Validasi No Telp
      const noTelp = document.querySelector('input[name="no_telp"]');
      if (!noTelp.value.trim()) {
        document.getElementById('no_telp-error').textContent = 'No Telp harus diisi';
        noTelp.classList.add('error-field');
        isValid = false;
      }
      
      // Validasi Gender
      const gender = document.querySelector('input[name="gender"]:checked');
      if (!gender) {
        document.getElementById('gender-error').textContent = 'Gender harus dipilih';
        isValid = false;
      }
      
      // Validasi Foto KTP
      const fotoKtp = document.querySelector('input[name="foto_ktp"]');
      if (!fotoKtp.files || fotoKtp.files.length === 0) {
        document.getElementById('foto_ktp-error').textContent = 'Foto KTP harus diupload';
        fotoKtp.classList.add('error-field');
        isValid = false;
      }
      
      if (isValid) {
        nextStep();
      }
    }
    
    function validateStep2() {
      resetErrors();
      let isValid = true;
      
      // Validasi Bertemu Dengan
      const bertemuDengan = document.querySelector('input[name="bertemu_dengan"]');
      if (!bertemuDengan.value.trim()) {
        document.getElementById('bertemu_dengan-error').textContent = 'Bertemu dengan harus diisi';
        bertemuDengan.classList.add('error-field');
        isValid = false;
      }
      
      // Validasi Tanggal & Jam
      const tanggalJam = document.querySelector('input[name="tanggal_jam"]');
      if (!tanggalJam.value) {
        document.getElementById('tanggal_jam-error').textContent = 'Tanggal & Waktu harus diisi';
        tanggalJam.classList.add('error-field');
        isValid = false;
      }
      
      // Validasi Keperluan
      const keperluan = document.querySelector('textarea[name="keperluan"]');
      if (!keperluan.value.trim()) {
        document.getElementById('keperluan-error').textContent = 'Keperluan harus diisi';
        keperluan.classList.add('error-field');
        isValid = false;
      }
      
      if (isValid) {
        nextStep();
      }
    }
    
    // Validasi form saat submit (step 3)
    document.getElementById('multiStepForm').addEventListener('submit', function(e) {
      resetErrors();
      let isValid = true;
      
      // Validasi Jawaban Video
      const jawabanVideo = document.querySelector('textarea[name="jawaban_video"]');
      if (!jawabanVideo.value.trim()) {
        document.getElementById('jawaban_video-error').textContent = 'Jawaban pertanyaan dari video harus diisi';
        jawabanVideo.classList.add('error-field');
        isValid = false;
        e.preventDefault();
        
        // Kembali ke step 3 jika ada error
        currentStep = 2;
        showStep(currentStep);
      }
      
      return isValid;
    });

    showStep(currentStep);
  </script>

</body>

</html>