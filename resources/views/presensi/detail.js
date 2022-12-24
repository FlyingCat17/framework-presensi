$(document).ready(function () {
    console.log('Berhasil Dipanggil!');
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
});