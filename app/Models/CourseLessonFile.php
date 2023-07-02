<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseLessonFile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_lesson_files';

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
        'course_lesson_id',
        'file'
    ];

    /**
     * @return HasOne
     */
    public function getFile(): HasOne
    {
        return $this->hasOne(MediaMultiLang::class, 'id', 'file');
    }

    public function getParentLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'id', 'course_lesson_id');
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
