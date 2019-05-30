<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');


class SiteController extends Controller
{
    protected $viewFolder = 'site';
    protected $name = 'Portal';

    public function actionIndex()
    {
        if (isset($_SESSION['login_user_id'])) {
            $this->redirect('/submission/index');
        }
        $error = null;
        if (isset($_POST['LoginForm'])) {
            $email = $_POST['LoginForm']['email'];
            $password = md5($_POST['LoginForm']['password']);
            $user = new User();
            $user = $user->findAllByAttributes(array('email'=>$email,'password'=>$password), true);
            if ($user) {
                $_SESSION['login_user_id'] = $user->id;
                if (User::checkRole($user->id, 'admin')) {
                    $_SESSION['login_user_role'] = 'admin';
                } else {
                    $_SESSION['login_user_role'] = 'member';
                }
                $this->redirect('/submission/index');
            } else {
                $error = 'Invalid Username or Password! Please try agian.';
            }
        }

        $this->render('login', array('error'=>$error));
    }

    public function actionError($code)
    {
        if ($code !== '403') {
            $code = '404';
        }
        $this->render('error_'.$code);
    }

    public function actionLogout()
    {
        if (session_destroy()) {
            $this->redirect('/');
            ;
        }
    }
}
