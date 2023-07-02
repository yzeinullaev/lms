<?php

declare(strict_types=1);

namespace App\Enums;

class PageTypeEnum
{
    const BANNERS = 'banners';
    const BLOCKS = 'blocks';
    const CONTACTS = 'contacts';
    const COURSES = 'courses';
    const DISCLAIMERS = 'disclaimers';
    const FAQ = 'faq';
    const NEWS = 'news';
    const REVIEWS = 'reviews';
    const SOCIALS = 'socials';
    const SPEAKERS = 'speakers';
    const TARIFFS = 'tariffs';
    const TERMS = 'terms';
    const USERS = 'users';
    const LANGUAGES = 'languages';
    const MENU = 'menu';
    const RECOMMENDED_NEWS = 'recommended_news';

    public const TYPES = [
        self::BANNERS => 'Баннер',
        self::BLOCKS => 'Блоки',
        self::CONTACTS => 'Контакты',
        self::COURSES => 'Курсы',
        self::DISCLAIMERS => 'Disclaimer',
        self::FAQ => 'FAQ',
        self::NEWS => 'Новости',
        self::REVIEWS => 'Отзывы',
        self::SOCIALS => 'Соц. Сети',
        self::SPEAKERS => 'Спикеры',
        self::TARIFFS => 'Тарифы',
        self::TERMS => 'Terms&Conditions',
        self::USERS => 'Пользователи',
        self::LANGUAGES => 'Языки',
        self::MENU => 'Меню',
        self::RECOMMENDED_NEWS => 'Рекомендуемые статьи',
    ];

    public const SELECTED_TYPES = [
        self::BANNERS => 'Баннер',
        self::BLOCKS => 'Блоки',
        self::CONTACTS => 'Контакты',
        self::DISCLAIMERS => 'Disclaimer',
        self::SPEAKERS => 'Спикеры',
    ];
}
