<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentCarton extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sent_cartons';

    public function carton()
    {
        return $this->hasOne('App\Carton');
    }
}
