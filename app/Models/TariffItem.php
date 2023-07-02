<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TariffItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tariff_items';

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
        'content',
        'icon',
        'tariff_id',
        'is_active'
    ];

    /**
     * @return HasOne
     */
    public function getContent(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'content');
    }

    /**
     * @return HasOne
     */
    public function getTariffBlock(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'block_id');
    }

    /**
     * @return HasOne
     */
    public function getMedia(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'icon');
    }

    /**
     * @param string $keyword
     * @param string $lang
     * @return Builder
     */
    public function search(string $keyword, string $lang): Builder
    {
        return $this->query()
            ->select($this->getTable() . '.*')
            ->leftJoin('translates as message', 'message.id', $this->getTable() . '.name')
            ->where('content.' . $lang, 'LIKE', '%' . $keyword . '%');
    }
}
