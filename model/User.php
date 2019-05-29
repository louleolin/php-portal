<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 9:17 AM
 */

require(__DIR__.'/../framework/Model.php');


class User extends Model
{
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $id;
    protected $role_id;

    protected $attributes = ['password','firstname','lastname','email','role_id'];
    protected $model_name = 'User';
    protected $table_name = 'users';

    public function validate(){
        return true;
    }

}