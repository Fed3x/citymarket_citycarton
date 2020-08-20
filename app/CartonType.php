<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartonType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carton_types';

    public function cartons()
    {
        return $this->hasMany('App\Carton');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description'];
}
