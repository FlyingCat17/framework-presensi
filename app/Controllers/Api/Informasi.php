<?php

namespace App\Controllers\Api;

use App\Models\Informasi as ModelsInformasi;

class Informasi
{
    public function index()
    {
        try {
            $informasi = ModelsInformasi::orderby('id_informasi', 'desc')->limit(10)->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        return Response::json(200, 'Berhasil mengambil data', $this->mapInformasi($informasi));
    }

    public function mapInformasi(array $informasi)
    {
        $url = '';
        $data = [];

        foreach ($informasi as $key => $value) {
            if (isset($value['thumbnail']) && !empty($value['thumbnail']) && $value['thumbnail'] != null) {
                $url = base_url . 'images/informasi/thumb/' . $value['thumbnail'];
            } else {
                $url = '';
            }
            $data[] = [
                'id_informasi' => $value['id_informasi'],
                'judul_informasi' => htmlspecialchars_decode($value['judul_informasi']),
                'isi_informasi' => htmlspecialchars_decode(htmlspecialchars_decode($value['isi_informasi'])),
                'thumbnail' => $url,
                'created_at' => $value['created_at'],
            ];
        }

        if (empty($data)) return [];

        return $data;
    }
}
