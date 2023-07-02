<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'translates';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $guarded = [];


}
