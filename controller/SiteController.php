<?php

require_once(__DIR__.'/../framework/Controller.php');
require_once(__DIR__.'/../model/User.php');


class SiteController extends Controller
{
    public function actionIndex(){
        $error = null;
        if (isset($_POST['LoginForm'])) {
            $email = $_POST['LoginForm']['username'];
            $password = md5($_POST['LoginForm']['password']);
            $user = new User();
            if ($user->findAllByAttributes(array('email'=>'admin@admin.com'))){
                $this->render('admin');
            }
        }else{
            $this->render('login',array('error'=>$error));
        }
    }

    public function actionAdmin(){
        $this->render('admin');
    }

}