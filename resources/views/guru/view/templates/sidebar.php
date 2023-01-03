<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable" id="ulNav">
            <li id="liNav"
                class="nav-item dropdown <?= strtolower($data['title']) === "dashboard guru" ? 'active' : '' ?>">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>dashboard">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">speed</i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown <?= strtolower($data['title']) === "mata pelajaran" ? 'active' : '' ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>g/mapel">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">book</i>
                    </span>
                    <span class="title">Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item dropdown <?=(strtolower($data['title']) === "jadwal" ? 'active' : (strtolower($data['title']) === "presensi" ? 'active' : (strtolower($data['title']) === "detail presensi" ? 'active' : ''))) ?>"
                id="liNav">
                <a class="dropdown-toggle d-flex pt-3" href="<?= base_url ?>g/jadwal">
                    <span class="icon-holder">
                        <i class="material-icons" style="font-size: 18px;">calendar_month</i>
                    </span>
                    <span class="title">Jadwal & Presensi</span>
                </a>
            </li>

        </ul>
    </div>
</div>