<?php

use Utils\Flasher;

Flasher::flash(); ?>
</div>
</div>
<?=(strtolower($data['title']) === "tambah presensi siswa") ? '<script src="' . base_url . 'resources/views/presensi/detail/insert.js"></script>' : '' ?>

</body>


</html>