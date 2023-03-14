<?php

namespace App\Models;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $table = '';

    const TABLE = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = static::TABLE;
    }


}