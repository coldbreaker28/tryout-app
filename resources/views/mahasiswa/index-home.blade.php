<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/home-mahasiswa.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <title>Ujian Online - Mahasiswa</title>
    </head>
    <body>

        <header>
            <h1>Ujian Online - Online Ujian</h1>
            @include('Components.navbar')
        </header>

        <main>
            <div class="ujian-card">
                <div class="head-card">
                    <span>Nim  : {{ Auth::user()->mahasiswa->nim }}</span><br>
                    <span>Nama : {{ Auth::user()->mahasiswa->nama }}</span><br>
                </div>
            </div>
        </main>

    </body>
</html>