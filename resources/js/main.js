/** 
 * modal ubah kelas
 */
$(document).on("click", "#btn-ubah-kelas", function () {
    var id_kelas = $(this).data('id');
    var nama_kelas = $(this).data('name');

    $("#nama_kelas").val(nama_kelas);
    $("#id_kelas").val(id_kelas);
    $("#ubah-kelas").modal();
});

$(document).on("click", "#btn-ubah-siswaa", function () {
    var nis = $(this).data('nis');
    var nama = $(this).data('nama');
    var kelamin = $(this).data('kelamin');
    var telepon = $(this).data('telepon');
    var alamat = $(this).data('alamat');
    if (kelamin == 'L' || kelamin == 'laki-laki') {
        var kelamin = 'radio1';
    } else {
        var kelamin = 'radio2';
    }
    $("#nis").val(nis);
    $("#nama").val(nama);
    // $("#kelamin").val( kelamin );
    // console.log(kelamin);
    document.getElementById(kelamin).checked = true;
    $("#telepon").val(telepon);
    $("#alamat").val(alamat);
    $("#ubah-siswa").modal();
});

$(document).on("click", "#header-logout", function () {
    window.location.href = $(this).data('logout');
});

$(document).on("click", "#header-edit", function () {
    window.location.href = $(this).data('edit');
});

