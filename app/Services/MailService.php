<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\NewsMail;
use App\Mail\SendMail;
use Exception;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class MailService
{

    public function __construct(private CourseService $courseService,
                                private ApplicationService $applicationService,
                                private NewsService $newsService
    )
    {
    }

    /**
     * @param array $data
     * @return SentMessage|null
     * @throws Exception
     */
    public function sendForm(array $data): ?SentMessage
    {
        try {
            $this->applicationService->create($data);
            $data['course'] = $this->courseService->getById($data['course_id'], $data['lang'])->first();
            return Mail::to($data['email'])->send(new SendMail($data));

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return SentMessage|null
     * @throws Exception
     */
    public function sendNews(array $data): ?SentMessage
    {
        try {
            return Mail::to($data['to'])->send(new NewsMail($data));

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
