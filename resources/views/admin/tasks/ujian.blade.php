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
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ujian.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <title>Kelola Ujian</title>
    </head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");
        *{
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
    </style>
    <body class="main-content text-decoration-none">
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

            <div class="content-tools">
                <a href="{{ route('admin.buat.soal') }}" role="button" title="Buat Soal" class="link-buat-soal">Buat Soal</a>
            </div>

            <div class="page-container" id="soal-container">
                @forelse ($soalUjians as $soalUjian)
                    <div class="page">
                        <!-- Tampilkan informasi soal di sini -->
                        <div class="page-body">
                            <p class="page-title font-monospace">{{ $soalUjian->pertanyaan }}</p>
                            <hr>
                            <a href="{{ route('admin.soal', $soalUjian->id) }}" role="button" class="kirim-btn">Detail Soal</a>
                        </div>
                        @empty
                            <div class="page-body">
                                <p class="page-title">There are no Soal Ujian.</p>
                            </div>
                    </div>
                @endforelse
            </div>
            {!! $soalUjians->withQueryString()->links('pagination::bootstrap-5') !!}
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