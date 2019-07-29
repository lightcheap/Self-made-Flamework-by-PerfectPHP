<?php

class Session
{
    protected static $sessionStarted = false;
    protected static $sessionIdRegenerates = false;

    public function __construct()
    {
        # コンストラクタが実行されたらセッションがスタート
        if (!self::$sessionStarted) {
            session_start();

            self::$sessionStarted = true;
        }
    }


    # $_SESSIONへの設定
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }


    # $_SESSIONへの取得
    public function get($name, $default = null)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return $default;
    }


    # $_SESSION から指定した値を削除
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }


    # $_SESSION をカラにする
    public function clear()
    {
        $_SESSION = array();
    }


    public function regenerated($destroy = true)
    {
        if (!self::$sessionIdRegenerates) {
            session_regenerate_id($destroy);

            self::$sessionIdRegenerates = true;
        }
    }


    public function setAuthenticated($bool)
    {
        $this->set('_authenticated', (bool)$bool);

        $this->regenerate();
    }


    public function isAuthenticated()
    {
        return $this->get('_authenticated', false);
    }
}