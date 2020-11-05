<?php namespace Ignite\Backend\Models;

class User extends \Ignite\Database\Model {
    protected $tableName = 'users';

    protected $hasOne = [
        'role' => 'Ignite\Backend\Models\Role'
    ];
}