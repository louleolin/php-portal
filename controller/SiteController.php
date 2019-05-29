<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');

session_start();

class SiteController extends Controller
{
    protected $viewFolder = 'site';


    public function actionIndex(){
      if (isset($_SESSION['login_user_id'])) {
        $this->redirect('/site/admin');
      }

        $error = null;
        if (isset($_POST['LoginForm'])) {
            $email = $_POST['LoginForm']['username'];
            $password = md5($_POST['LoginForm']['password']);
            $user = new User();
            $user = $user->findAllByAttributes(array('email'=>$email,'password'=>$password),true);
            if (isset($user)){
                $_SESSION['login_user_id'] = $user->id;
                $this->redirect('site/admin');
            }else{
              $error = 'Invalid Username or Password! Please try agian.';
            }
        }

        $this->render('login',array('error'=>$error));
    }

    public function actionAdmin(){
        $this->render('admin');
    }

    public function actionError($code){
        $this->render('error_'.$code);
    }

}
