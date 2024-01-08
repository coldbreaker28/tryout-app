<main>
    <nav class="nav-bar">
        <a href="{{ route('mahasiswa.home') }}">Beranda</a>
        <a href="{{ route('mahasiswa.profile', ['id' => Auth::id()]) }}">Profil</a>
        <a href="{{ route('mahasiswa.ujian')}}">Ujian</a>
        <a href="{{ route('mahasiswa.nilai') }}">Nilai</a>
        <a href="{{ route('logout') }}">Logout</a>
    </nav>
</main>
