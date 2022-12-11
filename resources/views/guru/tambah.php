<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
</head>
<?php
    if (isset($_POST['submit'])) {
        $guruController = new guruController;
        $guruController->simpan();
    }
?>
<body>
    <h1>Tambah Guru</h1>
    <form method="POST" >
        <label for="nuptk">NUPTK</label>
        <input type="text" name="nuptk" id="nuptk">
        <?= "<br>" ?>
        <label for="nama_guru">Nama Guru</label>
        <input type="text" name="nama_guru" id="nama_guru">
        <?= "<br>" ?>
        <label for="alamat_guru">Alamat Guru</label>
        <input type="text" name="alamat_guru" id="alamat_guru">
        <?= "<br>" ?>
        <label for="notelp_guru">No Telepon Guru</label>
        <input type="number" name="notelp_guru" id="notelp_guru">
        <?= "<br>" ?>
        <button type="submit" name="submit">Tambah</button>
    </form>
    <a href="<?= base_url; ?>/guru"><button type="submit">Kembali</button></a>
    <?php
        Message::flash();
    ?>
</body>

</html>