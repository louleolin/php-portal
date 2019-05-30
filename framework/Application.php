<?php

session_start();

class Application
{
    protected $controller;
    protected $action;
    protected $param;
    protected $allowed_controllers = ['site','submission','user'];

    public function resolve($url)
    {
        $url = ltrim($url, '/');
        if ($url == '' || $url == '/') {
            $this->controller = 'site';
            $this->action = 'index';
        } elseif (preg_match('/^[a-zA-Z]+(\/[a-zA-z]+)$/', $url)) {
            $url_array = explode('/', $url);
            $this->controller = $url_array[0];
            $this->action = $url_array[1];
        } elseif (preg_match('/^[a-zA-Z]+(\/[a-zA-z]+)+(\/[0-9]+)$/', $url)) {
            $url_array = explode('/', $url);
            $this->controller = $url_array[0];
            $this->action = $url_array[1];
            $this->param = $url_array[2];
        } else {
            $this->controller = 'site';
            $this->action = 'error';
        }

        if (!in_array($this->controller, $this->allowed_controllers)) {
            $this->controller = 'site';
            $this->action = 'error';
        }

        return true;
    }

    public function loadController($class_name)
    {
        $file_name = __DIR__."/../controller/".$class_name.'.php';
        require_once($file_name);
    }

    public function dispatch($url)
    {
        if (!isset($_SESSION['login_user_id']) || empty($_SESSION['login_user_id'])) {
            $url = '';
        }

        if ($this->resolve($url)) {
            $controller = $this->convertToController($this->controller);
            $this->loadController($controller);
            $controller_object = new $controller();
            $action = $this->convertToAction($this->action);
            if (method_exists($controller_object, $action)) {
                $controller_object->$action($this->param);
            } else {
                $controller_object->redirect('/site/error/404');
            }
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
