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
                    <form method="POST" action="{{ route('admin.soal.update', $soalUjians->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jenis_soal">Jenis Soal</label>
                            <select id="jenis_soal" name="jenis_soal" class="form-control @error('jenis_soal') is-invalid @enderror" required>
                                <option value="esai">Esai</option>
                                <option value="pilihan_ganda">Pilihan Ganda</option>
                            </select>

                            @error('jenis_soal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan</label>
                            <textarea id="pertanyaan" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" value="{{ $soalUjians->pertanyaan }}" aria-label="{{ $soalUjians->pertanyaan }}" required></textarea>

                            @error('pertanyaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_mata_pelajaran">Mata Pelajaran</label>
                            <select id="nama_mata_pelajaran" name="nama_mata_pelajaran" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror" required>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Matematika">Matematika</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                            </select>

                            @error('nama_mata_pelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jawaban_benar">Jawaban Benar</label>
                            <input id="jawaban_benar" type="text" name="jawaban_benar" class="form-control @error('jawaban_benar') is-invalid @enderror" value="{{ $soalUjians->jawaban_benar }}" required>

                            @error('jawaban_benar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Pilihan Ganda hanya muncul jika jenis soal adalah 'pilihan_ganda' -->
                        <div id="pilihan_ganda_fields" style="display: none">
                            <div class="form-group">
                                <label for="pilihan_a">Pilihan A</label>
                                <input id="pilihan_a" type="text" name="pilihan_a" class="form-control @error('pilihan_a') is-invalid @enderror" placeholder="opsi A">

                                @error('pilihan_a')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pilihan_b">Pilihan B</label>
                                <input id="pilihan_b" type="text" name="pilihan_b" class="form-control @error('pilihan_b') is-invalid @enderror"placeholder="opsi B">

                                @error('pilihan_b')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pilihan_c">Pilihan C</label>
                                <input id="pilihan_c" type="text" name="pilihan_c" class="form-control @error('pilihan_c') is-invalid @enderror" placeholder="opsi C">

                                @error('pilihan_c')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pilihan_d">Pilihan D</label>
                                <input id="pilihan_d" type="text" name="pilihan_d" class="form-control @error('pilihan_d') is-invalid @enderror" placeholder="opsi D">

                                @error('pilihan_d')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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