<?php namespace Ignite\Database;

class Model extends \Illuminate\Database\Eloquent\Model {
    protected $connection   = 'default';

    protected $primaryKey   = 'id';
    protected $incrementing = true;
}