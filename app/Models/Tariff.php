<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tariff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tariffs';

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
        'content',
        'price',
        'discount',
        'addition_price',
        'soon',
        'is_active'
    ];

    /**
     * @return HasOne
     */
    public function getName(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'name');
    }

    /**
     * @return HasOne
     */
    public function getContent(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'content');
    }

    /**
     * @return HasMany
     */
    public function getTariffItems(): HasMany
    {
        return $this->hasMany(TariffItem::class, 'tariff_id', 'id');
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
            ->where('message.' . $lang, 'LIKE', '%' . $keyword . '%');
    }
}
