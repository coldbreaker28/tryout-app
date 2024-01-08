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
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
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

            <article class="page-container2">
                <div class="page">
                    <div class="page-body">
                        <h3 class="page-title">Nama : {{ $data->nama }}</h3>
                        <p class="page-content">Email : {{ $data->user->email}}</p>
                        <h4 class="page-title">NIM : {{ $data->nim }}</h4>
                        <p class="page-content">Dibuat pada : {{ $data->updated_at->format('d-F-Y') }}</p>
                        <!-- Tambahkan tombol untuk melihat detail soal jika diperlukan --><br>
                        <div class="grup2-btn">
                            <a href="{{ route('admin.peserta.edit', $data->id) }}" class="edit-btn" title="Edit data soal ujian"><i class="fa-solid fa-pencil"></i> Edit identitas</a>
                            <form action="{{ route('admin.peserta.hapus', $data->id) }}" method="POST" class="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="hapus soal" class="hapus-btn">
                                    <i class="fa-regular fa-trash-can"></i> Hapus Pengguna
                                </button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('admin.peserta') }}" class="kembali-btn">kembali</a>
                </div>
            </article>

            <div class="table-container">
                <span>Hasil Peserta Ujian </span>
                <table class="responsive-table daftar-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Status</th>
                            <th scope="col">jawaban Mahasiswa</th>
                            <th scope="col">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jawaban as $data)
                        <tr>
                            <td style="border: 1px dashed #1B262C;" id="no">{{ $loop->iteration }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $data->updated_at->format('d-M-Y') }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $data->status }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $data->jawaban_mahasiswa }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $data->poin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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