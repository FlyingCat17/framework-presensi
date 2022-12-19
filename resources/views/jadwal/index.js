$(document).ready(function () {
    const base_url = $('meta[name=base_url]').attr('content');

    $('.tampilModalHapus').on('click', function () {
        // console.log($(this).data('id'));
        // $('#form_hapus').attr('action', base_url + 'jadwal/delete/' + $(this).data('id'));
        // console.log('idKelas : ' + $(this).data('idkelasajaran'));
        $('#form_hapus').attr('action', base_url + 'jadwal/kelas/' + $(this).data('idkelasajaran') + '/hapus/' + $(this).data('id'));
        $('#hapus_id').val($(this).data('id'));
        $('#hapus_kelas').html($(this).data('kelas'));
        $('#hapus_guru').html($(this).data('guru'));
        $('#hapus_jam').html(' (' + $(this).data('jam') + ')');
        $('#hapus_hari').html($(this).data('hari'));
        $('#hapus_mapel').html($(this).data('mapel'));
    });
});