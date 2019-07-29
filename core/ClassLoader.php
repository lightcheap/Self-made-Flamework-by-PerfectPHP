<?php
class ClassLoader
{
    protected $dirs;

    public function register() #オートローダークラスを登録する処理
    {
        #この関数に設定したコールバックがオートロード時に呼び出される。
        spl_autoload_register(array($this, 'loadclass'));
    }

    public function registerDir($dir) #探すディレクトリをいくつでも登録できるように
    {
        # $dirにはオートロードの対象のディレクトリへのフルパスを指定する
        $this->dir[] = $dir;
    }
    public function loadClass($class)
    {
        # オートロード時に呼び出される
        # クラスファイルの読み込みを行います。
        foreach($this->dirs as $dir){
            $file = $dir . '/' . $class . '.php';
            if (is_readable($file)){
                require $file;

                return;
            }
        }
    }

}