<?php

class Router
{
    protected $routes;

    public function __construct($definitions)
    {
        $this->routes = $this->compileRoutes($difinitions);
    }

    public function compileRoutes($difinitions)
    {
        $routes = array();

        foreach ($difinitions as $url => $params){
            # スラッシュごとにに分割する
            $tokens = explode('/', ltrim($url, '/'));
            foreach ($tokens as $i => $token){
                if (0 === strpos($token, ':')){
                    $name = substr($token, 1);
                    $token = '(?P<' . $name . '>[^/]+)';
                }
                $tokens[$i] = $token;
            }

            $pattern = '/' . implode('/', $tokens);
            $routes[$pattern] = $params;
        }

        return $routes;
    }

    public function resolve($path_info)
    {
        if ('/' !== substr($path_info, 0, 1)){
            $path_info = '/' . $path_info;
        }

        foreach ($this->routes as $pattern => $params){
            if (preg_match('#^'. $pattern . '$#', $path_info, $matches)){
                $params = array_merge($params, $matches);

                return $params;
            }
        }
        return false;
    }
}









