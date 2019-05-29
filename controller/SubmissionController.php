<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');

session_start();


class SubmissionController extends Controller
{
    protected $viewFolder = 'submission';

    public function actionIndex(){
        $user = new User();
        $user_id = $_SESSION['login_user_id'];
        $user = $user->findByPk($user_id);
        $submissions = new Submission();
        if ($user->getRole() === 'admin') {
            $submissions = $submissions->findAll();
        }else {
          $submissions = $submissions->findAllByAttributes(array('create_user_id'=>$user_id));
        }
        $this->render('index',array('submissions'=>$submissions));
    }

    public function actionCreate(){
      if (isset($_POST['Submission'])) {
        $post_submission = $_POST['Submission'];
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
