let durasiUjian = 90 * 60; // Durasi ujian dalam detik
        let timerInterval;

        function mulaiUjian() {
            document.getElementById('ujian-container').style.display = 'block';
            document.getElementById('mulai-btn').style.display = 'none';
            document.getElementById('selesai-btn').style.display = 'block';
            document.getElementById('timer').style.display = 'block';

            // Mulai menghitung waktu
            timerInterval = setInterval(function() {
                updateTimer();
                durasiUjian--;

                if (durasiUjian <= 0) {
                    selesaiUjian();
                }
            }, 1000);
        }

        function selesaiUjian() {
            clearInterval(timerInterval);
            document.getElementById('ujian-container').style.display = 'none';
            document.getElementById('mulai-btn').style.display = 'none';
            document.getElementById('selesai-btn').style.display = 'none';
            document.getElementById('timer').style.display = 'none';
        }

        function updateTimer() {
            let menit = Math.floor(durasiUjian / 60);
            let detik = durasiUjian % 60;

            // Tambahkan 0 di depan jika detik kurang dari 10
            detik = detik < 10 ? '0' + detik : detik;

            document.getElementById('waktu').innerText = menit + ':' + detik;
        }