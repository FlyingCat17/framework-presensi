
<style>
    .cards {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        margin: 37px auto 0;
        width: calc(280px * 4);
    }

    .card {
        box-shadow: 0 3px 10px 0 #aaa;
        cursor: pointer;
        height: 280px;
        position: relative;
        width: 243px;
    }

    .card h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .card.visited {
        box-shadow: 0 3px 10px 2px #444;
    }

    @media (max-width: 1100px) {
        .cards {
            grid-template-columns: 1fr 1fr;
            width: calc(280px * 2);
        }

        .card {
            margin: 0 auto 2rem;
        }
    }

    @media (max-width: 768px) {
        .cards {
            display: block;
            width: 100vw;
        }

        .card {
            margin: 0 auto 2rem;
        }
    }
</style>
<div class="page-container">
  <div class="main-content">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['kelas'] as $row) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['nama_kelas']; ?></td>
                    <td><?php
                        foreach ($data['jumlah_siswa'] as $isi) {
                            $jumlahSiswa = count($data['jumlah_siswa']);
                            for ($i = 0; $i < $jumlahSiswa; $i++) {
                                if ($row->id_kelas === $isi[0]->id_kelas) {
                                    if (count($isi) > 0) {
                                        echo count($isi);
                                    } else if (count($isi) === 0) {
                                        echo 0;
                                        echo $isi[0]->id_kelas;
                                    } else if (count($isi) === null) {
                                        echo 0;
                                    }
                                    break;
                                }
                            }
                        }
                        ?></td>
                    <td style="margin-left: 2;">
                        <a href="<?= base_url; ?>/kelas/detail/<?= $row['id_kelas'] ?>" class="badge badge-info">lihat</a>
                        <a href="<?= base_url; ?>/kelas/edit/<?= $row['id_kelas'] ?>" class="badge badge-info">Edit</a>
                        <a href="<?= base_url; ?>/kelas/hapus/<?= $row['id_kelas'] ?>" class="badge badge-danger" onclick="return confirm('Hapus data?');">Hapus</a>
                    </td>
                </tr>
            <?php $no++;
            endforeach; ?>
        </tbody>
    </table>
    <a href="<?= base_url; ?>/kelas/tambah" class="badge badge-info">Tambah Kelas</a>
  </div>
</div>