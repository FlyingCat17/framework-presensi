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
                break;
            case 2:
                return 'Selasa';
                break;
            case 3:
                return "Rabu";
                break;
            case 4:
                return 'Kamis';
                break;
            case 5:
                return 'Jumat';
                break;
            case 6:
                return 'Sabtu';
                break;
            default:
                return 'Minggu';
                break;
        }
    }
}
