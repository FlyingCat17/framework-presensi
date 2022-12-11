<?php

namespace App\Config;

use Riyu\Http\Request;

class Redirect
{
    private $url;

    public function __construct($url = null)
    {
        $this->url = $url;
        return $this->redirect($url);
    }

    public function redirect($url)
    {
        $url = $this->validate($url);
        header("Location: ".$url);
        exit;
    }

    private function validate($url)
    {
        if (is_array($this->url)) {
            $url = $url[0];
        }

        if (is_string($url)) {
            $url = $url;
        }

        if (is_null($url)) {
            $url = '/';
        }

        return $this->foundation($url);
    }

    function __destruct()
    {
        unset($this->url);
    }

    function foundation($url)
    {
        $fullUrl = Request::fullUrl();

        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $url = $this->validationUrl($url);
            $url = $fullUrl . $url;
        } else {
            $url = $url;
        }

        return $url;
    }

    public function validationUrl($url)
    {
        if (substr($url, 0, 1) == '/') {
            $url = substr($url, 1);
        }
        return $url;
    }
}
