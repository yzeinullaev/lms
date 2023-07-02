<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseLesson extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_lessons';

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
        'course_id',
        'file',
        'video',
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
    public function getParentCourse(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    /**
     * @return HasOne
     */
    public function getFile(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'file');
    }

    /**
     * @return HasOne
     */
    public function getMediaVideo(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'video');
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
