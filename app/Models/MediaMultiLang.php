<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaMultiLang extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_multi_langs';

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
