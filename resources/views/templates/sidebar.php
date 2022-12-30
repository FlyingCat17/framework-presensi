<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable" id="ulNav">
            <li id="liNav" class="nav-item dropdown <?= strtolower($data['title']) === "dashboard" ? 'active' : '' ?>">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>dashboard">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">speed</i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "siswa" ? 'active' : (strtolower($data['title']) === "hasil pencarian siswa" ? 'active' : '')) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>siswa">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">person</i>
                    </span>
                    <span class="title">Siswa</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "kelas" ? 'active' : (strtolower($data['title']) === "detail kelas" ? 'active' : '')) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>kelas">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">groups</i>
                    </span>
                    <span class="title">Kelas</span>
                </a>
            </li>
            <li class="nav-item dropdown <?= strtolower($data['title']) === "tahun ajaran" ? 'active' : '' ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>tahun_ajaran">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">event</i>
                    </span>
                    <span class="title">Tahun Ajaran</span>
                </a>
            </li>
            <li class="nav-item dropdown <?= strtolower($data['title']) === "guru" ? 'active' : '' ?>" id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>guru">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">supervised_user_circle</i>
                    </span>
                    <span class="title">Guru</span>
                </a>
            </li>
            <li class="nav-item dropdown <?= strtolower($data['title']) === "mata pelajaran" ? 'active' : '' ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>mapel">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">book</i>
                    </span>
                    <span class="title">Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "pembagian kelas" ? 'active' : '') ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>kelas/bagi">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">groups</i>
                    </span>
                    <span class="title">Pembagian Kelas</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "jadwal" ? 'active' : (strtolower($data['title']) === "presensi" ? 'active' : (strtolower($data['title']) === "detail presensi" ? 'active' : ''))) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>jadwal">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">calendar_month</i>
                    </span>
                    <span class="title">Jadwal & Presensi</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "ujian" ? 'active' : (strtolower($data['title']) === "tambah ujian" ? 'active' : (strtolower($data['title']) === "ubah ujian" ? 'active' : ''))) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>jadwal">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">free_cancellation</i>
                    </span>
                    <span class="title">Jadwal Ujian</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "Informasi Akademik" ? 'active' : (strtolower($data['title']) === "tambah Informasi Akademik" ? 'active' : (strtolower($data['title']) === "ubah Informasi Akademik" ? 'active' : ''))) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>jadwal">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">feed</i>
                    </span>
                    <span class="title">Informasi Akademik</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown <?php//(strtolower($data['title']) === "presensi" ? 'active' : (strtolower($data['title']) === "tambah presensi" ? 'active' : (strtolower($data['title']) === "detail presensi" ? 'active' : ''))) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?php// base_url ?>presensi">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">checklist_rtl</i>
                    </span>
                    <span class="title">Presensi</span>
                </a>
            </li> -->

        </ul>
    </div>
</div>