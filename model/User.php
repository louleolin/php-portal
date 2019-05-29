<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 9:17 AM
 */

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/model_config.php');



class User extends Model
{
    protected $password;
    public $firstname;
    public $lastname;
    public $email;
    public $id;
    public $role_id;

    protected $attributes = ['password','firstname','lastname','email','role_id'];
    protected $model_name = 'User';
    protected $table_name = 'users';

    public function validate(){
        return true;
    }

    public function getRole(){
      $current_user_role = new Role();
      $current_user_role = $current_user_role->findByPk($this->role_id);
      return $current_user_role->task;
    }
}
