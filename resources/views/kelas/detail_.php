<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?></title>
</head>
<body>
    <table>
        <?php
            $no = 1;
        ?>
        <tr>
            <th>no</th>
            <th>nama kelas</th>
            <th>nis</th>
            <th>nama siswa</th>
            <th>email</th>
            <th>alamat</th>
            <th>no telp</th>
            <th>jenis kelamin</th>
            <th>action</th>
        </tr>
        <?php foreach ($data['kelas'] as $row) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['nama_kelas']; ?></td>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['nama_siswa']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['no_telp']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td>
                    <a href="<?= base_url; ?>/siswa/edit/<?= $row['nis']; ?>">edit</a>
                    <a href="<?= base_url; ?>/siswa/delete/<?= $row['nis']; ?>">delete</a>
            </tr>
            <?php $no ++; endforeach; ?>
        </table>
        <a href="<?= base_url ?>/siswa/tambah/<?php echo $data['id_kelas'] ?>"><button type="submit">tambah</button></a>
</body>
</html>