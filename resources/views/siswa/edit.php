<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
</head>
<body>
    <form role="form" action="<?= base_url; ?>/siswa/update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="nis" value="<?= $data['siswa']->nis; ?>">
        <div class="card-body">
            <div class="form-group">
                <label>nama siswa</label>
                <input type="text" class="form-control" placeholder="masukkan nama siswa..." name="nama_siswa" value="<?= $data['siswa']->nama_siswa; ?>">
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="text" class="form-control" placeholder="masukkan email siswa..." name="email" value="<?= $data['siswa']->email; ?>">
            </div>
            <div class="form-group">
                <label>alamat</label>
                <input type="text" class="form-control" placeholder="masukkan alamat siswa..." name="alamat" value="<?= $data['siswa']->alamat_siswa; ?>">
            </div>
            <div class="form-group">
                <label>no telp</label>
                <input type="text" class="form-control" placeholder="masukkan no telp siswa..." name="no_telp" value="<?= $data['siswa']->notelp_siswa; ?>">
            </div>
            <div class="form-group">
                <label>jenis kelamin</label>
                <input type="text" class="form-control" placeholder="masukkan jenis kelamin siswa..." name="jenis_kelamin" value="<?= $data['siswa']->jenis_kelamin; ?>">
            </div>
            <div class="form-group">
                <label>id kelas</label>
                <input type="text" class="form-control" placeholder="masukkan id kelas siswa..." name="id_kelas" value="<?= $data['siswa']->id_kelas; ?>">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
    </form>
    <!-- button add siswa -->
    <a href="<?= base_url; ?>/siswa" class="btn btn-primary">kembali</a>
</body>
</html>