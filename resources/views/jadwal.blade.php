<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Sholat Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 30px;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 0.5em;
        }

        .jadwal-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1em;
            margin: 2em auto;
            max-width: 900px;
        }

        .box {
            background: #111;
            border: 2px solid #444;
            padding: 20px;
            border-radius: 12px;
        }

        .box h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .box p {
            font-size: 1.3rem;
            margin: 5px 0 0 0;
        }

        #next-prayer {
            font-size: 2rem;
            margin-top: 30px;
            color: #0f0;
        }

        #countdown {
            font-size: 3rem;
            margin-top: 10px;
            color: #ff0;
        }

        .ticker-container {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #b30000; /* merah khas TV One */
      color: white;
      font-weight: bold;
      font-size: 1.2em;
      white-space: nowrap;
      overflow: hidden;
      z-index: 9999;
    }

    .ticker-text {
      display: inline-block;
      padding-left: 100%;
      animation: ticker 20s linear infinite;
    }

    @keyframes ticker {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }
    </style>
</head>
<body>
    <h1>Jadwal Sholat Hari Ini - Pasaman Barat</h1>

    <div class="jadwal-container" id="jadwal-boxes">
        <!-- Box Jadwal akan diisi oleh JavaScript -->
    </div>

    

    <div id="next-prayer">Loading...</div>
    <div id="countdown">00:00</div>

    <audio id="adzan" src="/audio/adzan.mp3"></audio>
    <audio id="iqomah" src="/audio/iqomah.ogg"></audio>

    <!-- Ticker / Text Berjalan -->
  <div class="ticker-container">
    <div class="ticker-text" id="ticker-text">
      ✨ Assalamu’alaikum Warahmatullah Wabarakatuh | Selamat datang di Masjid Al-Furqan | Jaga kebersihan masjid, rapatkan shaf, sholat berjamaah tepat waktu | Info: Kajian rutin setiap Sabtu Ba’da Maghrib bersama Ust. Ahmad | اللهم اجعلنا من المقيمين الصلاة ✨
    </div>
  </div>

    <script>
        const jadwalBox = document.getElementById('jadwal-boxes');
        const adzanAudio = document.getElementById('adzan');
        const iqomahAudio = document.getElementById('iqomah');

        async function loadJadwal() {
            const res = await fetch('/api/jadwal-sholat');
            const data = await res.json();

            jadwalBox.innerHTML = '';

            const now = new Date();
            let next = null;

            data.forEach(item => {
                // Tampilkan box
                const div = document.createElement('div');
                div.className = 'box';
                div.innerHTML = `<h3>${item.nama}</h3><p>${item.waktu}</p>`;
                jadwalBox.appendChild(div);

                // Cari waktu selanjutnya
                const [h, m] = item.waktu.split(':').map(Number);
                const waktuSholat = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m);
                if (!next && waktuSholat > now) {
                    next = { ...item, waktu: waktuSholat };
                }
            });

            if (!next) return;

            document.getElementById('next-prayer').textContent = `Menuju ${next.nama}`;
            
            const interval = setInterval(() => {
                const now = new Date();
                const sisa = Math.floor((next.waktu - now) / 1000);

                if (sisa <= 0) {
                    clearInterval(interval);
                    adzanAudio.play();

                    document.getElementById('countdown').textContent = `Iqomah dalam ${next.iqomah} menit`;
                    setTimeout(() => iqomahAudio.play(), next.iqomah * 60 * 1000);
                    return;
                }

                const m = String(Math.floor(sisa / 60)).padStart(2, '0');
                const s = String(sisa % 60).padStart(2, '0');
                document.getElementById('countdown').textContent = `${m}:${s}`;
            }, 1000);
        }

        loadJadwal();
    </script>
</body>
</html>
