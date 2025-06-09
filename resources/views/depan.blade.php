<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Countdown Menuju Iqomah</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f0f4f8;
        text-align: center;
        padding: 20px;
    }

    h1 {
        font-size: 5vw; /* Responsive size */
        color: #2c3e50;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 7vw; /* Responsive size */
        color: #e74c3c;
    }

    @media (min-width: 768px) {
        h1 {
            font-size: 3vw; /* Tablet size */
        }

        h2 {
            font-size: 4vw;
        }
    }

    @media (min-width: 1024px) {
        h1 {
            font-size: 2vw; /* Desktop size */
        }

        h2 {
            font-size: 3vw;
        }
    }
</style>

</head>
<body>
    <h1 id="jam"></h1>
    <h2 id="countdown">Menghitung waktu menuju Iqomah...</h2>

    <script>
        async function getServerTimeAndIqomah() {
            const res = await fetch('/api/waktu-ntp');
            const data = await res.json();

            const serverTime = new Date(data.datetime).getTime();
            const iqomahTime = serverTime + (data.durasi_menuju_iqomah * 1000);

            return { iqomahTime, serverTime };
        }

        function startClock(serverTime) {
            const jamEl = document.getElementById('jam');

            setInterval(() => {
                serverTime += 1000;
                const waktuSekarang = new Date(serverTime);
                jamEl.textContent = waktuSekarang.toLocaleTimeString('id-ID', { hour12: false });
            }, 1000);
        }

        function startCountdown(iqomahTime, serverTime) {
            const countdownEl = document.getElementById('countdown');

            let now = serverTime;

            const interval = setInterval(() => {
                now += 1000;
                const distance = iqomahTime - now;

                if (distance <= 0) {
                    clearInterval(interval);
                    countdownEl.textContent = 'IQOMAH DIMULAI!';
                    window.location.href = '/tanggal';
                } else {
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownEl.textContent = `Menuju Iqomah: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }, 1000);
        }

        async function init() {
            const { iqomahTime, serverTime } = await getServerTimeAndIqomah();
            startClock(serverTime);
            startCountdown(iqomahTime, serverTime);
        }

        init();
    </script>
</body>
</html>
