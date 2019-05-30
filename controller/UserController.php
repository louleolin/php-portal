<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');


class UserController extends Controller
{
    protected $viewFolder = 'user';

    protected $name = 'Portal - User';

    public function actionIndex()
    {
        $user = new User();
        $user_id = $_SESSION['login_user_id'];
        $user = $user->findByPk($user_id);
        if ($user->checkRole($user_id, 'admin')) {
            $user_list = $user->findAll();
            $this->render('index', array('users'=>$user_list));
        } else {
            $this->redirect('/site/error/403');
        }
    }

    public function actionCreate()
    {
        $error = null;
        if ($_SESSION['login_user_role'] === 'admin') {
            if (isset($_POST['User'])) {
                $post_user = $_POST['User'];
                $new_user = new User();
                $new_user->firstname = $post_user['firstname'];
                $new_user->lastname = $post_user['lastname'];
                $new_user->email = $post_user['email'];
                $new_user->password = md5($post_user['password']);
                $new_user->role_id = $post_user['role_id'];
                if ($new_user->save()) {
                    $this->redirect('/user/index');
                } else {
                    $error = $new_user->errors;
                }
            }
            $roles = new Role();
            $roles = $roles->findAll();
            $this->render('create', array('roles'=>$roles,'error'=>$error));
        } else {
            $this->redirect('/site/error/403');
        }
    }

    public function actionEdit($id)
    {
        $user = new User();
        $user = $user->findByPk($id);
        if (isset($user)) {
            $error = null;
            if (isset($_POST['User'])) {
                $post_user = $_POST['User'];
                $user->firstname = $post_user['firstname'];
                $user->lastname = $post_user['lastname'];
                $user->password = md5($post_user['password']);
                $user->role_id = $post_user['role_id'];
                if ($user->saveEdit()) {
                    $this->redirect('/user/index');
                } else {
                    $error = $user->errors;
                }
            }
            $roles = new Role();
            $roles = $roles->findAll();
            $this->render('create', array('user'=>$user,'error'=>$error,'roles'=>$roles));
        } else {
            $this->redirect('/site/error/404');
        }
    }
}
