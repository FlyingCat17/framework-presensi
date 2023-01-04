<?php

use Utils\Flasher;

Flasher::flash(); ?>
</div>
</div>
<?=(strtolower($data['title']) === "tambah presensi siswa") ? '<script src="' . base_url . 'resources/views/presensi/detail/insert.js"></script>' : '' ?>

<?=(strtolower($data['title'] === "Tambah Informasi") ? '<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>' : (strtolower($data['title'] === "Ubah Informasi") ? '<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>' : '')) ?>
<?=(strtolower($data['title'] === "Tambah Informasi") ? '<script src="' . base_url . 'resources/vendors/quill/quill.min.js"></script>' : (strtolower($data['title'] === "Ubah Informasi") ? '<script src="' . base_url . 'resources/vendors/quill/quill.min.js"></script>' : '')) ?>
<?=(strtolower($data['title'] === "Tambah Informasi") ? '<script src="' . base_url . 'resources/views/informasi/tambah.js"></script>' : (strtolower($data['title'] === "Ubah Informasi") ? '<script src="' . base_url . 'resources/views/informasi/tambah.js"></script>' : '')) ?>
</body>


</html>