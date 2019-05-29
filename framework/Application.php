<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 8:48 AM
 */


class Application
{
    protected $controller;
    protected $action;
    protected $param;

    public function match($url)
    {
        $match = true;
        $url = ltrim($url, '/');
        if ($url == '' || $url == '/'){
            $this->controller = 'site';
            $this->action = 'index';
        }elseif (preg_match('/[a-zA-Z]+(\/[a-zA-z]+)/',$url)){
            $url_array = explode('/',$url);
            $this->controller = $url_array[0];
            $this->action = $url_array[1];
        }elseif(preg_match('/[a-zA-Z]+(\/[a-zA-z]+)+(\/[0-9]+)/',$url)){
            $url_array = explode('/',$url);
            $this->controller = $url_array[0];
            $this->action = $url_array[1];
            $this->param = $url_array[2];
        }else{
            $this->controller = 'site';
            $this->action = 'index';
        }
        return $match;
    }

    public function loadController($class_name){
        $file_name = __DIR__."/../controller/".$class_name.'.php';
        require_once ($file_name);
    }

    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = $this->convertToController($this->controller);
            $this->loadController($controller);
            if (class_exists($controller)) {
                $controller_object = new $controller();
                $action = $this->convertToAction($this->action);
                $controller_object->$action($this->param);
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }

    protected function convertToController($string)
    {
        return str_replace(' ', '', ucfirst(strtolower(str_replace('-', ' ', $string)))).'Controller';
    }


    protected function convertToAction($string)
    {
        return 'action'.ucfirst(strtolower(str_replace(' ', '', (str_replace('-', ' ', $string)))));
    }
}