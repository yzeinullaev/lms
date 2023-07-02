<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ErrorCodes extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'error_codes';

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
    protected $fillable = ['code', 'name'];

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
            ->where('message.' . $lang, 'LIKE', '%' . $keyword . '%')
            ->orWhere($this->getTable() . '.code', 'LIKE', '%' . $keyword . '%');
    }


    /**
     * @return HasOne
     */
    public function getMessage(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'name');
    }

}
