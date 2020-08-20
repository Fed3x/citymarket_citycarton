<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carton extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cartons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['barcode', 'carton_type_id', 'user_id','site_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function carton_type()
    {
        return $this->belongsTo('App\CartonType');
    }

    public function sent_carton()
    {
        return $this->hasOne('App\SentCarton');
    }
}
