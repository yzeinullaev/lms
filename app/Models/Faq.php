<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Faq extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faqs';

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
        'question',
        'answer',
        'is_active',
        'sort',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    /**
     * @return HasOne
     */
    public function getQuestion(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'question');
    }

    /**
     * @return HasOne
     */
    public function getAnswer(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'answer');
    }


    /**
     * @return BelongsTo
     */
    public function getMetaTitle(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'meta_title');
    }

    /**
     * @return BelongsTo
     */
    public function getMetaDescription(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'meta_description');
    }

    /**
     * @return BelongsTo
     */
    public function getMetaKeywords(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'meta_keywords');
    }
}
