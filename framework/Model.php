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

    protected static function db(){

        static $db = null;

        if ($db === null){
            // Create connection
            $db = new \mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
        }

        return $db;
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

        $db = $this->db();
        $result = $db->query($command);
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

            if ($return_first) {
                $return_array = $return_array[0];
            }

        }
        $db->close();
        return $return_array;
    }


    public function findAll(){
        $model_file= __DIR__.'/../model/'.$this->model_name.'.php';
        require_once ($model_file);

        $command = 'SELECT * FROM '.$this->table_name;
        $db = $this->db();
        $result = $db->query($command);
        $return_array = null;
        if ($result->num_rows > 0){
            $return_array = array();
            while($row = $result->fetch_assoc()) {
                $model = new $this->model_name();
                foreach ($this->attributes as $attribute){
                    $model->$attribute = $row[$attribute];
                }
                $return_array[] = $model;
            }
        }
        $db->close();
        return $return_array;
    }

    public function save(){
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

            $db = $this->db();
            if ($db->query($command) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $command . "<br>" . $db->error;
            }
        }
    }

    public function findByPk($id){
      return $this->findAllByAttributes(array('id'=>$id),true);
    }

    public function delete(){

    }

    public function validate(){
        return true;
    }
}
