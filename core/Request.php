<?php

class Request
{
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }

        return false;
    }

    public function getGet($name, $default = null)
    {
        if (isset($_GET[$name])){
            return $_GET[$name];
        }

        return $default;
    }

    public function getPost($name, $default = null)
    {
        if (isset($_POST[$name])){
            return $_POST[$name];
        }

        return $default;
    }

    public function getHost()
    {
        if (!empty($_SERVER['HTTP_HOST'])){
            return $_SERVER['HTTP_HOST'];
        }

        return $_SERVER['SERVER_NAME'];
    }

    public function isSsl()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            return true;
        }

        return false;
    }

    public function getRequestUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getBaseUrl()
    {
        $script_name = $_SERVER['SCRIPT_NAME'];

        $request_uri = $this->getRequestUri();

        if (0 === strpos($request_uri, $script_name)){ #フロントコントローラーがurlに含まれる場合
            return $script_name;

        }else if (0 === strpos($request_uri, dirname($script_name))){ #フロントコントローラーが省略されている場合
            return rtrim(dirname($script_name), '/');
        }

        return '';

    }

    public function getPathInfo()
    {
        $base_url = $this->getBaseUrl();
        $request_uri = $this->getRequestUri();

        #GETパラメータを含む場合urlに？が入るので？があるか判定
        if (false !== ($pos = strpos($request_uri, '?'))){
            # ？より前の部分を抜き出す
            $request_uri = substr($request_uri, 0, $pos);

        }
        # GET分を除いたrequest_uriからbase_url分の文字を除く
        $path_info = (string)substr($request_uri, strlen($base_url));

        return $path_info;

    }
}