<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tombol.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <title>Edit Data Soal</title>
    </head>
    <body class="main-content">
    @include('Components.sidebar')
        <div class="container-body" id="container-body">
            <div class="head-text">
                    <article>
                        <h2>Edit Soal Ujian</h2>
                        <h4>Entry data untuk Soal Ujian</h4>
                    </article>
                    <div class="right-menu" onclick="toggleRight()">
                        <span title="log-out" class="list" id="toggleBtn"><i class="fa-solid fa-ellipsis-vertical"></i></span>
                        <a role="button" title="log-out" href="{{ route('logout') }}" class="log-out hidden" id="logoutBtn">Logout</a>
                    </div>
                </div><br>
            <div class="form-container">
                <!-- <div class="title">Registrasi Siswa</div> -->
                <div class="card-body form-content">
                    <form method="POST" action="{{ route('admin.peserta.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Peserta</label>
                            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $data->user->name }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM Peserta</label>
                            <input id="nim" type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ $data->nim }}">

                            @error('nim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="grup-btn">
                            <a href="{{ route('admin.ujian') }}" role="button" class="kembali-btn">Kembali</a>
                            <button type="submit" class="kirim-btn">Simpan Soal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const errorMessages = document.querySelectorAll(".error-message");
            errorMessages.forEach(function (errorMessages){
                errorMessages.style.display = "flex";
            });
        });
        // Tampilkan atau sembunyikan pilihan ganda fields berdasarkan jenis soal
        document.getElementById('jenis_soal').addEventListener('change', function () {
            var jenisSoal = this.value;
            var pilihanGandaFields = document.getElementById('pilihan_ganda_fields');

            if (jenisSoal === 'pilihan_ganda') {
                pilihanGandaFields.style.display = 'block';
            } else {
                pilihanGandaFields.style.display = 'none';
            }
        });
    </script>
</html>