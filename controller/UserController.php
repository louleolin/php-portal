<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');


class UserController extends Controller
{
    protected $viewFolder = 'user';

    public function actionIndex(){
        $user = new User();
        $user_id = $_SESSION['login_user_id'];
        $user = $user->findByPk($user_id);
        $user_list = $user->findAll();
        if ($user->getRole() === 'admin') {
          $this->render('index',array('users'=>$user_list));
        }else {
          $this->redirect('/site/error/403');
        }
    }

    public function actionCreate(){
      if (isset($_POST['User'])) {
        $post_user = $_POST['User'];
        $submission = new Submission();
        $submission->title = $post_submission['title'];
        $submission->content = $post_submission['content'];
        $submission->create_user_id = $_SESSION['login_user_id'];
        $submission->create_time = date("Y-m-d H:i:s");
        $submission->save();
        $this->redirect('/submission/index');
      }
      $this->render('create');
    }

    public function actionView($id){
      $submission = new Submission();
      $submission = $submission->findByPk($id);
      if (isset($submission)) {
        $this->render('view',array('submission'=>$submission));
      }else{
        $this->redirect('/site/error/404');
      }
    }

}
