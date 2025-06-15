<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRiwayatSurat"
                    aria-expanded="false" aria-controls="collapseRiwayatSurat">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Kelola Data
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseRiwayatSurat" aria-labelledby="headingRiwayatSurat"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('komponen.data-master.data') }}">
                            Pegawai
                        </a>
                        <a class="nav-link" href="{{ route('komponen.data-master.unit') }}">
                            Unit
                        </a>
                        <a class="nav-link" href="{{ route('komponen.data-master.jabatan') }}">
                            Jabatan
                        </a>
                        <a class="nav-link" href="{{ route('komponen.data-master.jabatanpeg') }}">
                            Jabatan Pegawai
                        </a>
                    </nav>
                </div>

                <!-- Menu Detail Surat -->
                <a class="nav-link" href="{{ route('komponen.surat-masuk') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Surat Masuk
                </a>

                {{-- surat masuk --}}
                {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope-circle-check"></i></div>
                    Surat Masuk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div> --}}
                {{-- end --}}


                {{-- surat keluar --}}
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSurat"
    aria-expanded="false" aria-controls="collapseSurat">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    Surat Keluar
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseSurat" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="#">Pegawai</a>
        <a class="nav-link" href="#">Unit</a>
    </nav>
</div>


                <a class="nav-link" href="{{ route('komponen.riwayat-surat') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Riwayat Surat
                </a>
                <a class="nav-link" href="{{ route('komponen.kirim-surat') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Kirim Surat
                </a>
            </div>
        </div>
    </nav>
</div>
