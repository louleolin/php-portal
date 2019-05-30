<?php

abstract class Controller
{
    protected $name;
    protected $viewFolder;

    public function render($view, $param = null)
    {
        $file_name = __DIR__.'/../view/'.(isset($this->viewFolder)?$this->viewFolder.'/':'').$view.'.php';
        ob_start();
        if (isset($param)) {
            extract($param, EXTR_SKIP);
        }
        include($file_name);
        $content=ob_get_contents();
        ob_end_clean();
        $layout = __DIR__.'/../view/layout.php';
        ob_start();
        extract(array('content'=>$content,'title'=>$this->name,'user_role'=>(isset($_SESSION['login_user_role']) && !empty($_SESSION['login_user_role']))?$_SESSION['login_user_role']:null));
        include($layout);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    public function redirect($url)
    {
        header("Location:".$url, true, 301);
        exit();
    }
}
