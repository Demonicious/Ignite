<?php namespace Ignite\Database\Models;

class User extends \Ignite\Database\Model {
    protected $tableName = 'users';

    protected $hasOne = [
        'role' => 'Ignite\Backend\Models\Role'
    ];
}