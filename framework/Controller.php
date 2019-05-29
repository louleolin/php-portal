<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 8:20 AM
 */

abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];
    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */

    public function render($view,$param = null){
        $file_name = __DIR__.'/../view/'.$view.'.php';
        ob_start();
        if (isset($param)){
            extract($param, EXTR_SKIP);
        }
        include($file_name);
        $content=ob_get_contents();
        ob_end_clean();
        echo $content;
    }

    public function redirect($url){
        header("Location: https://www.rapidtables.com/web/dev/php-redirect.html",true,302);
        exit();
    }
}