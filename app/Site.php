<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites';

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function cartons()
    {
        return $this->hasMany('App\Carton');
    }

    public function poses()
    {
        return $this->hasMany('App\Pos');
    }
}
