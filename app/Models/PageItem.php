<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PageItem extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_items';

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
        'page_id',
        'item_type',
        'item_type_id',
        'sort',
        'is_active',
    ];

    /**
     * @return HasOne
     */
    public function getPage(): HasOne
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
