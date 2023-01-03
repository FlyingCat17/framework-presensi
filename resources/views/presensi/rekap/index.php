<?php
use App\Models\Detail_Presensi;
use App\Models\Presensi;
use App\Models\Jadwal;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <title>
        <?= $data['title'] ?>
    </title>

    <!-- <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script> -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->


</head>

<body>
    <div class="container-fluid">
        <div class="mx-3">
            <h3>Rekap Presensi SMAN PLUS SUKOWONO</h3>
            <h5>ID Jadwal&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : <?= $data['jadwal']->id_jadwal ?></h5>
            <h5>Guru&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : <?= $data['jadwal']->nama_guru ?></h5>
            <h5>Mata Pelajaran&emsp;&emsp;&emsp; : <?= $data['jadwal']->nama_mapel ?></h5>


            <div class="d-flex justify-content-end">
                <h6 class="text-end">Kelas : <?= $data['jadwal']->nama_kelas ?>&nbsp;</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered display" id="tbl_rekap">
                    <thead>
                        <tr>
                            <td style="max-width: 10px;">No</td>
                            <td style="max-width: 30px;">NIS</td>
                            <td style="min-width: 300px;">Nama Siswa</td>
                            <?php
                            $noPresensi = 1;
                            if (!empty($data['presensi'])) {
                                foreach ($data['presensi'] as $presensi): ?>
                                    <td style="min-width: 10px;"><?= $noPresensi ?></td>
                                    <?php
                                    $noPresensi++;
                                endforeach;
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $noNis = 1;
                        if (!empty($data['siswa'])) {
                            foreach ($data['siswa'] as $siswa):
                                ?>
                                <tr>
                                    <td><?= $noNis; ?></td>
                                    <td>
                                        <?= $siswa['nis'] ?>
                                    </td>
                                    <td><?= $siswa['nama_siswa'] ?></td>
                                    <?php foreach ($data['presensi'] as $presensi) {
                                    $detailPresensi = Detail_Presensi::where('tb_detail_presensi.id_presensi', $presensi['id_presensi'])
                                        ->select('tb_detail_presensi.kehadiran')
                                        ->where('tb_detail_presensi.nis', $siswa['nis'])
                                        ->all();
                                    $kehadiran = [
                                        'nis' => $siswa['nis'],
                                        'nama' => $siswa['nama_siswa'],
                                        'kehadiran' => $detailPresensi
                                    ];
                                    if ($kehadiran['kehadiran'] != null) {
                                        $hadir = $kehadiran['kehadiran'][0]['kehadiran'];
                                    } else {
                                        $hadir = 0;
                                    }
                                    // foreach ($detailPresensi as $detail) {
                                    ?>
                                        <td>
                                            <?php //($detail['kehadiran'] == '1' ? 'H' : ($detail['kehadiran'] == '2' ? 'I' : ($detail['kehadiran'] == '3' ? 'S' : ($detail['kehadiran'] == 'null' ? 'A' : '')))) ?>
                                            <?php
                                            switch ($hadir) {
                                                case '1':
                                                    echo 'H';
                                                    break;
                                                case '2':
                                                    echo 'I';
                                                    break;
                                                case '3':
                                                    echo 'S';
                                                    break;
                                                default:
                                                    echo 'A';
                                                    break;
                                            }
                                            // echo json_encode($detail['kehadiran']);
                                            ?>
                                        </td>
                                        <?php
                                    // }
                        
                                }
                                ?>
                                    <?php
                                    $noNis++;
                            endforeach;
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <!-- <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_rekap');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('RekapPresensi<?php $data['jadwal']->id_jadwal ?>.' + (type || 'xlsx')));
        }
    </script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tbl_rekap').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ]
            });
        });
    </script>
</body>

</html>