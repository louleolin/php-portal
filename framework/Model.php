<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 8:20 AM
 */


require_once('config.php');

abstract class Model
{
    protected $table_name;
    protected $model_name;
    protected $attributes;
    protected $rules;
    public $errors;
    public $db;


    public function __construct()
    {
        $this->db_initialise();
    }

    protected function db_initialise(){

        if ($this->db === null){
            // Create
            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
        }
    }

    public function findAllByAttributes(array $params,$return_first = false){
        $model_file= __DIR__.'/../model/'.$this->model_name.'.php';
        require_once ($model_file);

        $command = 'SELECT * FROM '.$this->table_name;
        $condition = '';

        foreach ($params as $key=>$value){
            if (in_array($key,$this->attributes) || $key == 'id'){
                $condition .= ' '.$key .'=\''.$value.'\' AND';
            }
        }

        if (!empty($condition)) {
          $condition = rtrim($condition,'AND');
        }
        $command = $command.' WHERE'.$condition;

        $result = $this->db->query($command);
        $return_array = null;
        if (isset($result) && $result){
            $return_array = array();
            while($row = $result->fetch_assoc()) {
                $model = new $this->model_name();
                $model->id = $row['id'];
                foreach ($this->attributes as $attribute){
                    $model->$attribute = $row[$attribute];
                }
                $return_array[] = $model;
            }

            if ($return_first && !empty($return_array)) {
                $return_array = $return_array[0];
            }elseif (empty($return_array)){
                return null;
            }

        }
        return $return_array;
    }


    public function findAll(){
        $model_file= __DIR__.'/../model/'.$this->model_name.'.php';
        require_once ($model_file);

        $command = 'SELECT * FROM '.$this->table_name;
        $result = $this->db->query($command);
        $return_array = null;
        if ($result->num_rows > 0){
            $return_array = array();
            while($row = $result->fetch_assoc()) {
                $model = new $this->model_name();
                $model->id = $row['id'];
                foreach ($this->attributes as $attribute){
                    $model->$attribute = $row[$attribute];
                }
                $return_array[] = $model;
            }
        }
        return $return_array;
    }

    public function save(){
        $saved =false;
        if ($this->validate()){
            $command = 'INSERT INTO '.$this->table_name;
            $attributes_string = '';
            $values_string = '';
            foreach ($this->attributes as $attribute){
                $attributes_string .= $attribute .',';
                $values_string .= '\''.$this->$attribute .'\',';
            }
            $attributes_string = rtrim($attributes_string,',');
            $values_string = rtrim($values_string,',');

            $command .= '('.$attributes_string.') VALUES ('.$values_string.')';

            if ($this->db->query($command) === TRUE) {
              $saved = true;
            }
        }
        return $saved;
    }

    public function findByPk($id){
      return $this->findAllByAttributes(array('id'=>$id),true);
    }

    public function delete(){
        $deleted = false;
        $command = 'DELETE FROM '.$this->table_name.' WHERE id = \''.$this->id.'\'';
        if ($this->db->query($command) === TRUE) {
            $deleted = true;
        }
        return $deleted;
    }

    public function validate(){
        return true;
    }

}
