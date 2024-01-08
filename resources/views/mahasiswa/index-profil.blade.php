<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/profile-mahasiswa.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <title>Profile Mahasiswa</title>
    </head>
    <body>
        <header>
            <h1>Profile Mahasiswa</h1>
            @include('Components.navbar')
        </header>

        <div class="container">
            <div class="profile-info">
                <div class="profile-details">
                    <h2>{{ $profile->mahasiswa->nama }}</h2>
                    <p><span>NIM :</span> {{ $profile->mahasiswa->nim }}</p>
                    <p><span>Email :</span> {{ $profile->email }}</p>
                    <p><span>Dibuat pada : </span> {{ $profile->updated_at->format('d-F-Y') }}</p>
                    <p><span>Skor Sementara : </span> {{ $profile->mahasiswa->skor }}</p>
                </div>
            </div>

            <!-- Add more details as needed -->

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
        @include('Components.footer')
    </body>
</html>