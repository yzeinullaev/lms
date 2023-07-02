<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

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
        'news_category_id',
        'date',
        'images',
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
     * @return HasOne
     */
    public function getNewsCategory(): HasOne
    {
        return $this->hasOne(NewsCategory::class, 'id', 'news_category_id');
    }

    /**
     * @return HasOne
     */
    public function getMedia(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'images');
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
