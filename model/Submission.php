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
      return true;
    }
}
