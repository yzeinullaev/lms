<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

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
        'user_id',
        'user_type',
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
    public function getUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
