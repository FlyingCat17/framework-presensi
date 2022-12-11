<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
</head>

<body>
    <h1>Edit Guru</h1>
    <form action="<?= base_url; ?>/guru/update" method="post">
        <label for="nuptk">NUPTK</label>
        <input type="text" name="nuptk" id="nuptk" value="<?= $data['guru']['nuptk']; ?>">
        <?= "<br>" ?>
        <label for="nama_guru">Nama Guru</label>
        <input type="text" name="nama_guru" id="nama_guru" value="<?= $data['guru']['nama_guru']; ?>">
        <?= "<br>" ?>
        <label for="alamat_guru">Alamat Guru</label>
        <input type="text" name="alamat_guru" id="alamat_guru" value="<?= $data['guru']['alamat_guru']; ?>">
        <?= "<br>" ?>
        <label for="notelp_guru">No Telepon Guru</label>
        <input type="number" name="notelp_guru" id="notelp_guru" value="<?= $data['guru']['notelp_guru']; ?>">
        <?= "<br>" ?>
        <button type="submit">Update</button>
    </form>
    <a href="<?= base_url; ?>/guru"><button type="submit">Kembali</button></a>
    <?php

    use Utils\Flasher;

    Flasher::flash();
    ?>
</body>

</html>