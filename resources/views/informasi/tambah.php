<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {

        $informasi = new informasiController();
        $informasi->simpan();
    }
    ?>
    <form method="POST">
        <input type="text" name="judul" id="judul" placeholder="judul"></br></br>
        <input type="text" name="konten" id="konten" placeholder="konten"></br></br>
        <input type="submit" value="submit" name="submit"></br>
    </form>
    <?php Message::flash(); ?>
</body>

</html>