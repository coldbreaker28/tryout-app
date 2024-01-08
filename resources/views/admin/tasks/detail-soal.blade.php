<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tombol.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ujian.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <title>Detail Soal</title>
    </head>
    <body class="main-content">
        @include('Components.sidebar')
        <div class="container-body" id="container-body">
            <div class="head-text">
                <article>
                    <h2>Kelola Data Ujian</h2>
                    <h4>Jadwal yang tersedia, Materi Ujian, dan Buat Soal Ujian</h4>
                </article>
                <div class="right-menu" onclick="toggleRight()">
                    <span title="log-out" class="list" id="toggleBtn"><i class="fa-solid fa-ellipsis-vertical"></i></span>
                    <a role="button" title="log-out" href="{{ route('logout') }}" class="log-out hidden" id="logoutBtn">Logout</a>
                </div>
            </div>

            <article class="page-container">
                <div class="page">
                    <div class="page-body">
                        <h3 class="page-title">{{ $soalUjians->pertanyaan }}</h3>
                        <p class="page-content">Jawaban benar : {{ $soalUjians->jawaban_benar}}</p><br>
                        <p class="page-content">Mata Pelajaran : {{ $soalUjians->mataPelajaran->nama }}</p>
                        <p class="page-content">Jenis soal : {{ $soalUjians->jenis_soal }}</p>
                        <p class="page-content">Dibuat pada : {{ $soalUjians->updated_at->format('d-F-Y') }}</p>
                        <!-- Tambahkan tombol untuk melihat detail soal jika diperlukan --><br>
                        <div class="grup2-btn">
                            <a href="{{ route('admin.soal.edit', $soalUjians->id) }}" class="edit-btn" title="Edit data soal ujian"><i class="fa-solid fa-pencil"></i> Edit Soal</a>
                            <form action="{{ route('admin.soal.hapus', $soalUjians->id) }}" method="POST" class="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="hapus soal" class="hapus-btn">
                                    <i class="fa-regular fa-trash-can"></i> Hapus soal
                                </button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('admin.ujian') }}" class="kembali-btn">kembali</a>
                </div>
            </article>
        </div>
        <script>
            function toggleRight() {
                const toggleBtn = document.getElementById('toggleBtn');
                const logoutBtn = document.getElementById('logoutBtn');

                // Check the current state and toggle visibility based on that
                if (toggleBtn.classList.contains('hidden')) {
                    // If the span is hidden, show it and hide the anchor
                    toggleBtn.classList.remove('hidden');
                    logoutBtn.classList.add('hidden');
                } else {
                    // If the span is visible, hide it and show the anchor
                    toggleBtn.classList.add('hidden');
                    logoutBtn.classList.remove('hidden');
                }
            }
        </script>
    </body>
</html>