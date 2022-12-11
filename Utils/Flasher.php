<?php
namespace Utils;

/**
 * Class Message
 * 
 * @package    app\core
 * 
 */
class Flasher
{

    public static function setFlash($pesan, $type)
    {
        $_SESSION['pesan_flash'] = [
            'pesan' => $pesan,
            'type' => $type
        ];
    }

    /**
     * method untuk menampilkan pesan
     */
    public static function flash()
    {
        if (isset($_SESSION['pesan_flash'])) {
            $pesan = $_SESSION['pesan_flash']['pesan'];
            echo '<div class="alert alert-' . $_SESSION['pesan_flash']['type'] . '">'
                . $pesan . '</div>';
            unset($_SESSION['pesan_flash']);
        }
    }
}
