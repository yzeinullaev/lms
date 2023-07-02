<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubscriptionChange extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscription_changes';

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
        'subscription_id',
        'before_tariff_id',
        'before_payment_id',
        'before_date',
        'after_tariff_id'
    ];

    /**
     * @return HasOne
     */
    public function getSubscribe(): HasOne
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }

    /**
     * @return HasOne
     */
    public function getBeforeTariff(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'before_tariff_id');
    }

    /**
     * @return HasOne
     */
    public function getAfterTariff(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'after_tariff_id');
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
    public function getBeforePayment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'before_payment_id');
    }
}
