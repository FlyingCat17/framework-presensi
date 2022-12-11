$(document).ready(function () {
    const base_url = $('meta[name=base_url]').attr('content');
    $('#TambahKehadiran').change(function () {
        $(this).find("option:selected").each(function () {
            var OptionValue = $(this).attr('value');
            if (OptionValue == 2 || OptionValue == 3) {
                $('#izin').removeClass("d-none");
            } else {
                $('#izin').addClass("d-none");
            }
        });
    });
    $('#tutupModalTambahPresensi').on('click', function () {
        $('#TambahKehadiran').val("null");
        $('#izin').addClass("d-none");
        $('#nis-tambah-presensi').html("");
        $('#nama-tambah-presensi').html("");
    });
    $('.tampilModalTambahPresensi').on('click', function () {
        const nis = $(this).data('nis');
        const nama = $(this).data('nama');
        $('#nis-tambah-presensi').html(nis);
        $('#nama-tambah-presensi').html(nama);
        $('#nis-tambah-presensi').data('nis', nis);
        $('#nama-tambah-presensi').data('nama', nama);
    });
    $('#btn_save_tambah').on('click', function () {
        var nis = $("#nis-tambah-presensi").data('nis');
        var nama = $("#nama-tambah-presensi").data('nama');
        var id_presensi = $("#_getIdPresensi").data('idpresensi');
        var nama_kelas = $("#_get_nama_kelas").data('nama_kelas');
        var nama_mapel = $("#_get_nama_mapel").data('nama_mapel');
        var status = $('#TambahKehadiran').val();
        var bukti = "";
        // console.log(nis + " " + nama);
        if ($('#TambahKehadiran').val() == "null") {
            alert('Harap isi Status Kehadiran!');
        }
        $.ajax({
            url: base_url + "presensi/insert_detail_presensi",
            type: "POST",
            data: {
                nis: nis,
                nama: nama,
                id_presensi: id_presensi,
                nama_kelas: nama_kelas,
                nama_mapel: nama_mapel,
                status: status,
                bukti: bukti
            },
            cache: false,
            success: function (result) {
                var result = JSON.parse(result);
                if (result.statusCode == 200) {
                    location.href = base_url + "presensi/detail_presensi/" + id_presensi;
                } else if (result.statusCode == 201) {
                    location.href = base_url + "presensi/detail_presensi/" + id_presensi;
                }
            }
        });



    });

});