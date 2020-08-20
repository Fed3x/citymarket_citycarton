<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'point_of_sales';

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
