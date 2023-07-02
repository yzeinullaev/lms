<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
        'slug',
        'flip_box_content',
        'images',
        'video',
        'url',
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
    public function getFlipBoxContent(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'flip_box_content');
    }

    /**
     * @return HasOne
     */
    public function getLink(): HasOne
    {
        return $this->hasOne(Translate::class, 'id', 'url');
    }

    /**
     * @return HasOne
     */
    public function getMedia(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'images');
    }

    /**
     * @return HasOne
     */
    public function getMediaVideo(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'video');
    }

    /**
     * @return HasMany
     */
    public function getPrograms(): HasMany
    {
        return $this->hasMany(CourseProgram::class, 'course_id', 'id');
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
