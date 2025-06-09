<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Countdown Iqomah</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #111;
      color: #0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .countdown {
      font-size: 5rem;
      border: 4px solid #0f0;
      padding: 40px 80px;
      border-radius: 20px;
      box-shadow: 0 0 20px #0f0;
    }
  </style>
</head>
<body>

<div class="countdown" id="countdown">05:00</div>

<script>
  let duration = 1 * 60; // 5 menit dalam detik
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
    }
  }

  updateCountdown();
</script>

</body>
</html>
