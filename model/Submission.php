<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/model_config.php');

class Submission extends Model
{
    public $id;
    public $title;
    public $content;
    public $create_time;
    public $create_user_id;

    protected $attributes = ['title','content','create_time','create_user_id'];
    protected $model_name = 'Submission';
    protected $table_name = 'submissions';
    protected $editable_attributes = ['title','content'];

    public function validate($edit=false)
    {
        $error_array = array();
        if (!isset($this->title) || empty($this->title)) {
            array_push($error_array, 'Submission title cannot be null!');
        }

        if (!isset($this->content) || empty($this->content)) {
            array_push($error_array, 'Submission content cannot be null!');
        }
        if (empty($error_array)) {
            return true;
        } else {
            $this->errors = $error_array;
        }
        return false;
    }

    public function getCreateUserName()
    {
        $user = new User();
        $user = $user->findByPk($this->create_user_id);
        return $user->firstname.' '.$user->lastname;
    }
}
