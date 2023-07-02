<?php

namespace App\Repositories;

use App\Models\CourseLessonFile;
use App\Repositories\Eloquent\BaseRepository;

class CourseLessonFilesRepository extends BaseRepository
{
    public function __construct(CourseLessonFile $model,
                                MediaMultiLangRepository $mediaMultiLangRepository)
    {
        $this->mediaMultiLangRepository = $mediaMultiLangRepository;
        parent::__construct($model);
    }
}
