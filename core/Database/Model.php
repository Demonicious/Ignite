<?php namespace Ignite\Database;

class Model extends \Illuminate\Database\Eloquent\Model {
    protected $connection   = 'default';
    protected $primaryKey   = 'id';
    
    public $timestamps   = true;
    public $incrementing = true;
}