<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Countdown Iqomah + Tanggal & Jam</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #000;
      color: #0f0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .datetime {
      text-align: center;
      margin-bottom: 40px;
    }

    .date {
      font-size: 2rem;
    }

    .clock {
      font-size: 3rem;
      margin-top: 5px;
    }

    .countdown {
      font-size: 5rem;
      border: 4px solid #0f0;
      padding: 30px 60px;
      border-radius: 20px;
      box-shadow: 0 0 20px #0f0;
    }
  </style>
</head>
<body>

<div class="datetime">
  <div class="date" id="currentDate"></div>
  <div class="clock" id="currentTime"></div>
</div>

<div class="countdown" id="countdown">05:00</div>

<script>
  // Format nama hari dan bulan dalam Bahasa Indonesia
  const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

  function updateDateTime() {
    const now = new Date();
    
    // Tanggal
    const tgl = `${hari[now.getDay()]}, ${now.getDate()} ${bulan[now.getMonth()]} ${now.getFullYear()}`;
    document.getElementById('currentDate').textContent = tgl;

    // Jam
    const jam = now.toLocaleTimeString('id-ID', { hour12: false });
    document.getElementById('currentTime').textContent = jam;
  }

  setInterval(updateDateTime, 1000);
  updateDateTime();

  // Countdown Iqomah
  let duration = 1 * 60; // 5 menit
  const display = document.getElementById('countdown');

  function updateCountdown() {
    const minutes = Math.floor(duration / 60);
    const seconds = duration % 60;

    display.textContent = 
      `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

    if (duration > 0) {
      duration--;
      setTimeout(updateCountdown, 1000);
    } else {
      display.textContent = "IQOMAH!";
      display.style.color = '#f00';
      display.style.borderColor = '#f00';
      display.style.boxShadow = '0 0 20px #f00';
      window.location.href = '/jadwal-sholat';
    }
  }

  updateCountdown();
</script>

</body>
</html>
