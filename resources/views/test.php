<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<style>

</style>
<body>
    <style>
        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
        }

        .container-100 {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <div class="container-100">
        <h1>Generate Siswa</h1>
        <form action="/generate/siswa" method="post">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah">
            <button type="submit">Generate</button>
        </form>

        <h1>Generate Presensi</h1>
        <form action="/generate/presensi" method="post">
            <label for="jadwal">Jadwal</label>
            <input type="number" name="jadwal" id="jadwal">
            <br>
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah">
            <button type="submit">Generate Presensi</button>
        </form>

        <h1>Generate Detail Presensi</h1>
        <form action="/generate/detail-presensi" method="post">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah">
            <button type="submit">Generate Detail Presensi</button>
        </form>

        <h1>Generate Informasi</h1>
        <form action="/generate/informasi" method="post">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah">
            <button type="submit">Generate Informasi</button>
        </form>
    </div>
</body>
</html>