$(document).ready(function () {
    const base_url = $('meta[name=base_url]').attr('content');
    // console.log(base_url);
    // console.log(base_url);
    $('#tambah_jadwal').on('click', function () {
        // console.log('ok');
        $(this).attr('href', base_url + 'jadwal/tambah_jadwal');
    });
    $('.edit_jadwal').on('click', function () {
        // console.log('OKSKDJ');
        $(this).attr('href', base_url + 'jadwal/ubah_jadwal/' + $(this).data('id'));
    });
    $('.buka_presensi').on('click', function () {
        // console.log('OKSKDJ');
        $(this).attr('href', base_url + 'presensi/detail/' + $(this).data('id'));
    });
    $('.tampilModalHapus').on('click', function () {
        // console.log($(this).data('id'));
        $('#hapus_id').val($(this).data('id'));
        $('#hapus_kelas').html($(this).data('kelas'));
        $('#hapus_guru').html($(this).data('guru'));
        $('#hapus_jam').html(' (' + $(this).data('jam') + ')');
        $('#hapus_hari').html($(this).data('hari'));
        $('#hapus_mapel').html($(this).data('mapel'));
    });
});