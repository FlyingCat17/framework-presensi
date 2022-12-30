$(document).ready(function () {
    console.log('LOHJ??');
    const base_url = $('meta[name=base_url]').attr('content');
    $('#TambahKehadiran').change(function () {
        $(this).find("option:selected").each(function () {
            var OptionValue = $(this).attr('value');
            if (OptionValue == 2 || OptionValue == 3) {
                $('#izin').removeClass("d-none");
            } else {
                $('#izin').addClass("d-none");
                $('#file').val('');
                $('.file').val('');
                $('#file').html('');
            }
        });
    });
    $('.tampilModalTambahPresensi').on('click', function () {
        const nis = $(this).data('nis');
        const nama = $(this).data('nama');
        $('#nis-tambah-presensi').html(nis);
        $('#nama-tambah-presensi').html(nama);
        $('#nis-tambah-presensi').data('nis', nis);
        $('#nama-tambah-presensi').data('nama', nama);
    });
    $('.browse').on('click', function () {
        var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        // var reader = new FileReader();
        // reader.onload = function (e) {
        //     // get loaded data and render thumbnail.
        //     document.getElementById("preview").src = e.target.result;
        // };
        // read the image file as a data URL.
        // reader.readAsDataURL(this.files[0]);
        // console.log($(this).val());
    });
    // $('#btn_save_tambah').on('click', function () {
    //     var nis = $('#nis-tambah-presensi').data('nis');
    //     var id_jadwal = $(this).data('jadwal');
    //     var id_presensi = $(this).data('idpresensi');
    //     var kehadiran = $('#TambahKehadiran').val();
    //     var url = base_url + 'presensi/' + id_jadwal + '/detail/' + id_presensi;

    //     switch (kehadiran) {
    //         case '1':
    //             $.ajax({
    //                 url: base_url + 'presensi/' + id_jadwal + '/detail/' + id_presensi,
    //                 method: 'POST',
    //                 data: {
    //                     nis: nis,
    //                     kehadiran: kehadiran,
    //                 },
    //                 cache: false,
    //                 success: function (result) {
    //                     alert(result);
    //                     location.href = url;
    //                 },
    //                 error: function (xhr, status, error) {
    //                     console.error(xhr);
    //                 }
    //             });
    //             break;
    //         case '2':
    //             console.log('Izin');
    //             break;
    //         case '3':
    //             console.log('Sakit');
    //             break;
    //         default:
    //             // alert('Harap Isi Kehadiran!');
    //             break;
    //     }
    // if ($('#TambahKehadiran').val() == 'null') {
    //     alert('Harap Isi Kehadiran!' + id_presensi);
    // } else {

    // }
    // console.log(nis);
    // console.log($(this).data('jadwal'));
    // console.log($(this).data('idpresensi'));
    // });
});