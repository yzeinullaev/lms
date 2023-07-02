# LMS admin
Админка для LMS + api для фронта
# Требование
- PHP ^8.0.2
- Supported databases:
- -  MySQL 8.0+
- - PostgreSQL 9.5+
- Laravel 9
# Установка
```
composer install
php artisan migrate & db:seed
```
#env
- Для платежки подключен ePay (https://epayment.kz/docs/)
```
EPAY_TEST
EPAY_CLIENT_ID
EPAY_CLIENT_SECRET
EPAY_TERMINAL
EPAY_FRONT_BACK_LINK
EPAY_FRONT_FAILED_BACK_LINK
#EPAY_POST_LINK
#EPAY_FAILED_POST_LINK
EPAY_POST_LINK
EPAY_FAILED_POST_LINK
EPAY_ACCOUNT_ID
```
