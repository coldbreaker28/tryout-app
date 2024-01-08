<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/tombol.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ujian.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home-mahasiswa.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ujian-mahasiswa.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <title>Halaman Ujian</title>
    </head>
    <body>
        <header><h1>Halaman Ujian</h1>@include('Components.navbar')</header>
        <div class="soal-container">
            <button id="mulai-btn" onclick="mulaiUjian()">Mulai Ujian</button>
            <div id="timer">Waktu Tersisa: <span id="waktu">90:00</span></div>
            <div id="ujian-container">
            <form action="{{ route('submit.jawaban') }}" method="post">
    @csrf
    <div class="page-container">
        @forelse ($soal as $soalUjian)
            <div class="page">
                <!-- Tampilkan informasi soal di sini -->
                <div class="page-body">
                    <h3 class="page-title">{{ $soalUjian->pertanyaan ?? '-' }}</h3>
                    @if ($soalUjian->jenis_soal == 'pilihan ganda')
                        <!-- Tampilkan pilihan-pilihan untuk soal pilihan ganda -->
                        <div class="pilihan-ganda">
                            @foreach (['A', 'B', 'C', 'D'] as $index => $label)
                                <label>
                                    <input type="radio" name="jawaban_mahasiswa[{{ $soalUjian->id }}]" value="{{ 'pilihan_' .  strtolower($label)}}" data-soal-id="{{ $soalUjian->id }}">
                                    {{ $label }}. {{ $soalUjian['pilihan_' . strtolower($label)] }}
                                </label>
                            @endforeach
                        </div>
                        @error("jawaban_mahasiswa.{$soalUjian->id}")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif
                    <hr>
                    <p class="page-content">Mata Pelajaran : {{ $soalUjian->mataPelajaran->nama ?? '-' }}</p>
                </div>
            </div>
        @empty
            <div class="page-body">
                <p class="page-title">There are no Soal Ujian.</p>
            </div>
        @endforelse

        <button id="selesai-btn" type="submit" onclick="selesaiUjian()">Selesai Ujian</button>
    </div>
</form>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Inisialisasi waktu ujian jika belum diset
                let durasiUjian = localStorage.getItem('durasiUjian');
                if (!durasiUjian || durasiUjian <= 0) {
                    durasiUjian = 10 * 60; // Durasi ujian dalam detik
                    localStorage.setItem('durasiUjian', durasiUjian);
                }

                // Tampilkan waktu ujian saat halaman dimuat
                updateTimer();

                // Jalankan fungsi per detik
                let timerInterval;

                function startTimer() {
                    timerInterval = setInterval(function () {
                        // Kurangi durasi ujian
                        durasiUjian--;

                        // Simpan durasi ujian di local storage
                        localStorage.setItem('durasiUjian', durasiUjian);

                        // Update tampilan waktu ujian
                        updateTimer();

                        // Jika waktu ujian habis, lakukan sesuatu, misalnya kirim form secara otomatis
                        if (durasiUjian <= 0) {
                            clearInterval(timerInterval);
                            alert('Waktu ujian habis!');
                        }
                    }, 1000);
                }

                // Fungsi untuk memperbarui tampilan waktu ujian
                function updateTimer() {
                    let menit = Math.floor(durasiUjian / 60);
                    let detik = durasiUjian % 60;

                    // Tambahkan 0 di depan jika detik kurang dari 10
                    detik = detik < 10 ? '0' + detik : detik;

                    // Tampilkan waktu pada elemen dengan ID 'waktu'
                    document.getElementById('waktu').innerText = menit + ':' + detik;
                }

                document.getElementById('mulai-btn').addEventListener('click', function () {
                    startTimer();
                    document.getElementById('ujian-container').style.display = 'block';
                    document.getElementById('mulai-btn').style.display = 'none';
                    document.getElementById('selesai-btn').style.display = 'block';
                    document.getElementById('timer').style.display = 'block';
                });

                document.getElementById('selesai-btn').addEventListener('click', function () {
                    clearInterval(timerInterval);
                    localStorage.removeItem('durasiUjian'); // Hapus nilai durasiUjian dari localStorage
                    document.getElementById('ujian-container').style.display = 'none';
                    document.getElementById('mulai-btn').style.display = 'none';
                    document.getElementById('selesai-btn').style.display = 'none';
                    document.getElementById('timer').style.display = 'none';
                });
            });
        </script>
        @include('Components.footer')
    </body>
</html>