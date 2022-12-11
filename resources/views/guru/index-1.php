<div class="page-container">
    <div class="main-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NUPTK</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data['guru'] as $row) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['nuptk']; ?></td>
                        <td><?= $row['nama_guru']; ?></td>
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
    </div>
</div>