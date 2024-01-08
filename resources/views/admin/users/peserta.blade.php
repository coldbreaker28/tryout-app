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
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <script src="{{ asset('js/filter.js') }}"></script>
        <title>Peserta Ujian</title>
    </head>
    <body class="main-content">
        @include('Components.sidebar')
        <div class="container-body" id="container-body">
            <div class="head-text">
                <article>
                    <h2>Peserta Ujian</h2>
                    <h4>Rekap data Peserta Ujian</h4>
                </article>
                <div class="right-menu" onclick="toggleRight()">
                    <span title="log-out" class="list" id="toggleBtn"><i class="fa-solid fa-ellipsis-vertical"></i></span>
                    <a role="button" title="log-out" href="{{ route('logout') }}" class="log-out hidden" id="logoutBtn">Logout</a>
                </div>
            </div>
            <div class="table-container">
                <h2>Tabel Peserta Ujian</h2>
                <div class="group-filter">
                    <h5>Filter dengan : </h5>
                    <input type="search" placeholder="cari data peserta berdasarkan nomor peserta" class="filter-cari" data-table="daftar-table">
                    <div class="contain-btn">
                        <button id="sort-ascending" class="filter-btn" data-table="daftar-table" title="1 - 10 / A - Z">
                            <i class="fa-solid fa-circle-chevron-up"></i>Asc
                        </button>
                        <button id="sort-descending" class="filter-btn" data-table="daftar-table" title="10 - 1 / Z - A">
                            <i class="fa-solid fa-circle-chevron-down"></i>Desc
                        </button>
                    </div>
                </div>
                <hr>
                <table class="responsive-table daftar-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td style="border: 1px dashed #1B262C;" id="no">{{ $loop->iteration }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $item->nama }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $item->email }}</td>
                            <td style="border: 1px dashed #1B262C;" >{{ $item->nim }}</td>
                            <td style="border: 1px dashed #1B262C;" id="aksi">
                                <a href="{{ route('admin.peserta.detail', $item->id) }}" class="detail-btn">Detail Peserta</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            const sortAscendingButton = document.getElementById("sort-ascending");
            const sortDescendingButton = document.getElementById("sort-descending");

            const table = document.querySelector("table");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.getElementsByTagName("tr"));

            function sortTable(columnIndex, ascending) {
                rows.sort((a, b) => {
                    const cellA = a.getElementsByTagName("td")[columnIndex].textContent.trim();
                    const cellB = b.getElementsByTagName("td")[columnIndex].textContent.trim();
                    
                    if (ascending) {
                        return cellA.localeCompare(cellB);
                    } else {
                        return cellB.localeCompare(cellA);
                    }
                });

                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }

                rows.forEach(row => {
                    tbody.appendChild(row);
                });
            }

            sortAscendingButton.addEventListener("click", () => {
                sortTable(0, true); // Menggunakan indeks 0 untuk mengurutkan berdasarkan ID.
            });

            sortDescendingButton.addEventListener("click", () => {
                sortTable(0, false); // Menggunakan indeks 0 untuk mengurutkan berdasarkan ID.
            });

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