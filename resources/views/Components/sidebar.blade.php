<main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <div class="side-content">
        <div class="sidebar" id="sidebar">
            <button class="toggle-btn" onclick="toggleSidebar()" title="Menu"><i class="bx bx-menu"></i></button>
            <ul>
                <li class="menu sub-toggle">
                    <div class="menu-item">
                        <a href="{{ route('admin.home') }}" role="button" title="Beranda"><i class="fa-solid fa-gauge"></i><span class="menu-text">Beranda</span></a>
                    </div>
                </li>
                <br>
                <li class="menu sub-toggle">
                    <div class="menu-item">
                        <a href="{{ route('admin.peserta') }}" title="menu peserta" role="button" ><i class="fa-solid fa-user-group"></i><span class="menu-text">Peserta</span></a>
                    </div>
                </li>
                <br>
                <li class="menu sub-toggle">
                    <div class="menu-item">
                        <a href="{{ route('admin.ujian') }}" role="button" title="Ujian"><i class="fa-solid fa-table-list"></i><span class="menu-text">Ujian</span></a>
                    </div>
                </li>
                <br>
                <li class="menu sub-toggle">
                    <div class="menu-item">
                        <a href="{{ route('admin.laporan') }}" title="menu laporan" role="button" ><i class="fa-solid fa-chart-column"></i><span class="menu-text">Laporan</span></a>
                    </div>
                </li>
            </ul>
            <!-- <span class="cr">Made By Us</span> -->
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const containerbody = document.getElementById("container-body");
            const toggleBtn = document.querySelector(".toggle-btn");
            const containerCard = document.getElementById("card-container");

            if (sidebar.classList.contains("active")) {
                sidebar.classList.remove("active");
                containerbody.style.margin = window.innerWidth >= 480 ? "0px 90px" : "0px 10px";
                toggleBtn.classList.remove("active");
                containerCard.style.width = "69%";
            } else {
                sidebar.classList.add("active");
                containerbody.style.margin = window.innerWidth >= 480 ? "0px 90px 0px 180px" : "0px 10px";
                toggleBtn.classList.add("active");
                containerCard.style.width = "75%";
            }
        }
    </script>
</main>