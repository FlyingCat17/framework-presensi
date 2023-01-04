<?php
namespace App\Controllers\Api;

class Response extends \Riyu\Http\Response
{
    /**
     * Response json
     * 
     * @param array $data
     * @param string $message
     * @param int $status
     * 
     * @return void
     */
    public static function json($status = 200, $message = '', $data = [])
    {
        self::code($status);

        parent::json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
        
        exit;
    }

    /**
     * Response json
     * 
     * @param array $data
     * 
     * @return string
     */
    public static function toJson(array $data)
    {
        return json_encode($data);
    }

    /**
     * Response json
     * 
     * @param array $data
     * 
     * @return string
     */
    public static function toJsonPretty(array $data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public static function url(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}