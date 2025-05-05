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

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <label>No Telp</label>
        <input type="text" name="no_telp" required>

        <label>Gender</label>
        <div class="gender-group">
          <label><input type="radio" name="gender" value="L" required> Laki-laki</label>
          <label><input type="radio" name="gender" value="P"> Perempuan</label>
        </div>

        <label>Upload Foto KTP</label>
        <input type="file" name="foto_ktp" accept="image/*" required>

        <div class="btn-group">
          <span></span>
          <button type="button" onclick="nextStep()">Selanjutnya</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <label>Bertemu dengan</label>
        <input type="text" name="bertemu_dengan" required>

        <label>Tanggal & Waktu</label>
        <input type="datetime-local" name="tanggal_jam" required>

        <label>Keperluan</label>
        <textarea name="keperluan" required></textarea>

        <div class="btn-group">
          <button type="button" onclick="prevStep()">Sebelumnya</button>
          <button type="button" onclick="nextStep()">Selanjutnya</button>
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

    showStep(currentStep);
  </script>

</body>

</html>