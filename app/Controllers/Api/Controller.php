<?php
namespace App\Controllers\Api;

use App\Controllers\Api\Traits\Mapping;
use App\Controllers\Api\Traits\Query;
use App\Controllers\Api\Traits\Rule;

class Controller
{
    use Rule, Query, Mapping;

    protected function verifyPassword($password, $hash, $type = 'login')
    {
        if ($type == 'login') {
            if (!password_verify($password, $hash)) {
                return Response::json(403, 'Password salah');
            }
        }

        if ($type == 'reset') {
            if (password_verify($password, $hash)) {
                return Response::json(400, 'Password baru tidak boleh sama dengan password lama');
            }
        }
    }

    protected function validate(array $file)
    {
        if (!isset($file) || empty($file) || $file['error'] != 0 || !array($file)) {
            return;
        }

        if (!is_file($file['tmp_name'])) {
            return Response::json(400, 'Foto tidak valid');
        }

        $ekstensi = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($ekstensi != 'jpg' && $ekstensi != 'jpeg' && $ekstensi != 'png') {
            return Response::json(400, 'Ekstensi foto tidak valid');
        }

        if ($file['size'] > 10000000) {
            return Response::json(400, 'Ukuran foto terlalu besar');
        }
    }

    /**
     * Compress image
     * 
     * @param string $source
     * @param string $destination
     * @param int $quality
     * 
     * @return string destination
     */
    protected function compress($source, $destination, $quality)
    {
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }
        imagejpeg($image, $destination, $quality);
        return $destination;
    }

    protected function daysSelector($days)
    {
        switch (strtolower($days)) {
            case 1:
                return 'Senin';
            case 2:
                return 'Selasa';
            case 3:
                return "Rabu";
            case 4:
                return 'Kamis';
            case 5:
                return 'Jumat';
            case 6:
                return 'Sabtu';
            default:
                return 'Minggu';
        }
    }

    protected function typeUjian($type)
    {
        switch ($type) {
            case 1:
                return 'UTS Ganjil';
            case 2:
                return 'UAS Ganjil';
            case 3:
                return 'UTS Genap';
            case 4:
                return 'UAS Genap';
            default:
                return 'Ulangan Harian';
        }
    }
}
