<?php

require_once(__DIR__ .'/../framework/config.php');
require_once(__DIR__ .'/model_config.php');


class User extends Model
{
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $id;
    public $role_id;

    protected $attributes = ['password', 'firstname', 'lastname', 'email', 'role_id'];
    protected $model_name = 'User';
    protected $table_name = 'users';
    protected $editable_attributes = ['password','firstname','lastname','role_id'];

    public static function checkRole($id, $role)
    {
        $valid = false;
        $command = 'SELECT * FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.id = ' . $id . ' AND r.task = \'' . $role . '\'';
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $result = $db->query($command);
        if ($result) {
            if ($result->num_rows > 0) {
                $valid = true;
            }
        }
        $db->close();
        return $valid;
    }

    public function validate($edit=false)
    {
        $error_array = array();

        if (!isset($this->password) || empty($this->password)) {
            array_push($error_array, 'User password cannot be null!');
        }

        if (!isset($this->firstname) || empty($this->firstname)) {
            array_push($error_array, 'User first name cannot be null!');
        }

        if (!isset($this->lastname) || empty($this->lastname)) {
            array_push($error_array, 'User last name cannot be null!');
        }

        if (!$edit) {
          if (!isset($this->email) || empty($this->email)) {
              array_push($error_array, 'User email cannot be null!');
          } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
              array_push($error_array, 'User email address is invalid!');
          } elseif ($this->findAllByAttributes(array('email' => $this->email))) {
              array_push($error_array, 'User email address is in use!');
          }
        }


        if (!isset($this->role_id) || empty($this->role_id)) {
            array_push($error_array, 'User role cannot be null!');
        }

        if (empty($error_array)) {
            return true;
        } else {
            $this->errors = $error_array;
        }
        return false;
    }

    public function getRole()
    {
        $current_user_role = new Role();
        $current_user_role = $current_user_role->findByPk($this->role_id);
        return $current_user_role->name;
    }
}
