<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
</head>

<body>
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
                            for ($i = 0; $i < count($data['jumlah_siswa']); $i++) {
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
</body>

</html>