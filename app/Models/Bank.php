<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'bik', 'code'];

    public function getName()
    {
        return $this->hasOne(Translate::class, 'id', 'name');
    }
}
