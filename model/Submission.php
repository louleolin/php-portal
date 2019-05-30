<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 9:17 AM
 */

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

    public function validate(){
        $error_array = array();
      if (!isset($this->title) || empty($this->title)) {
          array_push($error_array, 'Submission title cannot be null!');
      }

          if (!isset($this->content) || empty($this->content)){
              array_push($error_array, 'Submission content cannot be null!');
          }
        if (empty($error_array)) {
            return true;
        } else {
            $this->errors = $error_array;
        }
        return false;
    }
}
