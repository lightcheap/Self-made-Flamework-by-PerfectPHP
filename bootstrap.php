<?php
# この段階ではClassLoaderは読みこまれていないため、
# requireで読み込みます
require 'core/ClassLoader.php';

# ClassLoader のインスタンス
$loader = new ClassLoader();
# core, modelをオートロードの対象に設定する
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/model');
#  オートロードに登録する
$loader->register();