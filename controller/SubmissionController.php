<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/../model/model_config.php');



class SubmissionController extends Controller
{
    protected $viewFolder = 'submission';

    protected $name = 'Portal - Submission';

    public function actionIndex()
    {
        $submissions = new Submission();
        if ($_SESSION['login_user_role'] === 'admin') {
            $submissions = $submissions->findAll();
        } else {
            $submissions = $submissions->findAllByAttributes(array('create_user_id'=>$_SESSION['login_user_id']));
        }
        $this->render('index', array('submissions'=>$submissions));
    }

    public function actionCreate()
    {
        $error = null;
        if (isset($_POST['Submission'])) {
            $post_submission = $_POST['Submission'];
            $submission = new Submission();
            $submission->title = $post_submission['title'];
            $submission->content = $post_submission['content'];
            $submission->create_user_id = $_SESSION['login_user_id'];
            $submission->create_time = date("Y-m-d H:i:s");
            if ($submission->save()) {
                $this->redirect('/submission/index');
            } else {
                $error = $submission->errors;
            }
        }
        $this->render('create', array('error'=>$error));
    }

    public function actionView($id)
    {
        $submission = new Submission();
        $submission = $submission->findByPk($id);
        if (isset($submission)) {
            $this->render('view', array('submission'=>$submission));
        } else {
            $this->redirect('/site/error/404');
        }
    }

    public function actionEdit($id)
    {
        $submission = new Submission();
        $submission = $submission->findByPk($id);
        if (isset($submission)) {
            $error = null;
            if (isset($_POST['Submission'])) {
                $post_submission = $_POST['Submission'];
                $submission->title = $post_submission['title'];
                $submission->content = $post_submission['content'];
                if ($submission->saveEdit()) {
                    $this->redirect('/submission/index');
                } else {
                    $error = $submission->errors;
                }
            }
            $this->render('create', array('submission'=>$submission,'error'=>$error));
        } else {
            $this->redirect('/site/error/404');
        }
    }

    public function actionDelete($id)
    {
        $submission = new Submission();
        $submission = $submission->findByPk($id);
        if (isset($submission)) {
            $submission->delete();
        }
        $this->redirect('/submission/index');
    }
}
