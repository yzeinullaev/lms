<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

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
        'course_id',
        'tariff_id',
        'user_id',
        'payment_id',
        'payment_status',
        'start_subscribe',
        'end_subscribe'
    ];

    /**
     * @return HasOne
     */
    public function getCourse(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    /**
     * @return HasOne
     */
    public function getTariff(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }

    /**
     * @return HasOne
     */
    public function getUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function getPayment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
