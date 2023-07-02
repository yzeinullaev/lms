<?php

namespace App\Console\Commands;

use App\Services\MailService;
use App\Services\NewsService;
use App\Services\UserService;
use Illuminate\Console\Command;

class sendNews extends Command
{
    protected $signature = 'send-news';
    protected $name = 'send-news';
    protected $description = 'Отправляем новости по дате публикации пользователям у кого есть подписка на новости';

    public function __construct(
        private UserService $userService,
        private NewsService $newsService,
        private MailService $mailService,
    )
    {
        parent::__construct();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function handle(): mixed
    {
        $users = $this->userService->getUserWithNewsNotification();
        $newsToday = $this->newsService->getByPublicationDate();

        return $newsToday->map(function ($news) use ($users) {
            return $users->map(function ($user) use ($news) {
                return $this->mailService->sendNews([
                    'to' => $user->email,
                    'news' => $news
                ]);
            });
        });
    }
}
