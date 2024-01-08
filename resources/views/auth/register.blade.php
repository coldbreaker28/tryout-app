<!-- resources/views/auth/register.blade.php -->

@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <!-- Tambahkan tombol collapse -->
                            <a href="#userCollapse" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="userCollapse" class="btn btn-primary">
                                Register as Admin
                            </a>
                            <!-- Tambahkan tombol collapse -->
                            <a href="#mahasiswaCollapse" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mahasiswaCollapse" class="btn btn-primary">
                                Register as Mahasiswa
                            </a>
                        </div>
                        <hr>

                        <div class="collapse mb-4" id="userCollapse">
                            <!-- Formulir untuk pendaftaran sebagai user -->
                            <form method="POST" action="{{ route('register.user') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tambahkan elemen input dan validasi untuk tipe user (user) -->
                                <input type="hidden" name="tipe_user" value="user">

                                @include('auth.partials.registration-form-admin')

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register as User') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="collapse mb-2" id="mahasiswaCollapse">
                            <!-- Formulir untuk pendaftaran sebagai mahasiswa -->
                            <form method="POST" action="{{ route('register.mahasiswa') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus>
                                        </div>
                                        @error('nim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tambahkan elemen input dan validasi untuk tipe user (mahasiswa) -->
                                <input type="hidden" name="tipe_user" value="mahasiswa">

                                @include('auth.partials.registration-form-mahasiswa')

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register as Mahasiswa') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Deteksi perubahan pada elemen yang akan di-collapse
        $('.collapse').on('show.bs.collapse', function () {
            // Menutup collapse lain saat satu collapse ditampilkan
            $('.collapse').not(this).collapse('hide');
        });
        function togglePassword1() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
        function togglePassword2() {
            var passwordField = document.getElementById("password2");
            var eyeIcon = document.querySelector(".toggle-password2");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
@endsection