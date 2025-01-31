<?php

require_once(__DIR__.'/../framework/config.php');
require_once(__DIR__.'/model_config.php');

class Role extends Model
{
    public $id;
    public $name;
    public $task;

    protected $attributes = ['name','task'];
    protected $model_name = 'Role';
    protected $table_name = 'roles';

}
