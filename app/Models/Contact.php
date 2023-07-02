<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'address',
        'email',
        'map_url',
        'is_active'
    ];

    /**
     * @param string $keyword
     * @param string $lang
     * @return Builder
     */
    public function search(string $keyword, string $lang): Builder
    {
        return $this->query()
            ->select($this->getTable() . '.*')
            ->where('phone', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('address', 'LIKE', '%' . $keyword . '%');
    }

}
