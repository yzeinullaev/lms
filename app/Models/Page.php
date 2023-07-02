<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
        'slug',
        'menu',
        'is_active',
    ];

    /**
     * @return HasOne
     */
    public function getName(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'name');
    }

    /**
     * @return HasMany
     */
    public function getPageItems(): HasMany
    {
        return $this->hasMany(PageItem::class, 'page_id', 'id');
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
