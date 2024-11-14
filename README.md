<b>Модуль CRM для керування клієнтами з використанням фреймворку Laravel</b>
<br><br>
Головні рекомендації щодо програмного забезпечення:<br>
PHP 8.3.6<br>
Composer 2.8.2<br>
Laravel 11<br>
MySQL 8.0.40<br>
redis-server 7.0.15<br>
php-redis<br>
повний перелік можна переглянути в yurchenko-anton-payalnya/doc/projectDependencies.txt
<br><br>
Встановлення:
<br>
1.Завантажити проект
git:
git clone https://github.com/satnetuser001/yurchenko-anton-payalnya.git
архив:
https://github.com/satnetuser001/yurchenko-anton-payalnya/archive/refs/heads/main.zip
<br>
2.Встановити PHP пакети, виконати команду в терміналі у папці проекту yurchenko-anton-payalnya:
composer install
<br>
3.У MySQL створити базу даних та користувача:
mysql -uroot -p
CREATE DATABASE payalnya
CHARACTER SET utf8
COLLATE utf8_general_ci;
CREATE USER 'payalnya_app'@'localhost' IDENTIFIED BY '1077';
GRANT ALL PRIVILEGES ON payalnya.* TO 'payalnya_app'@'localhost';
exit
<br>
4.Накотити backup, команду виконати в терміналі у папці yurchenko-anton-payalnya/doc/mysqlDumpDB:
mysql -uroot -p payalnya < payalnya.sql
<br><br>
5.Запуск
Відкрити два термінали у папці yurchenko-anton-payalnya та запустити команди і не закривати термінали:
у першому:
php artisan serve
у другому:
php artisan queue:work
<br><br>
6.Відкрити у браузері:
http://127.0.0.1:8000/
<br><br>
Покрокове створення проекту описано у файлі yurchenko-anton-payalnya/doc/developmentLog.txt