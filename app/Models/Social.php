<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Social extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'socials';

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
        'name',
        'url',
        'image',
        'is_active'
    ];

    /**
     * @return HasOne
     */
    public function getMedia(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'images');
    }

    /**
     * @return HasOne
     */
    public function getLink(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'url');
    }

    public function search(string $keyword, string $lang): Builder
    {
        return $this->query()
            ->select($this->getTable() . '.*')
            ->where('name', 'LIKE', "%$keyword%")
            ->orWhere('url', 'LIKE', "%$keyword%")
            ->orWhere('image', 'LIKE', "%$keyword%");
    }
}
