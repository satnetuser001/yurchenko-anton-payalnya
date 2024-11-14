<b>Модуль CRM для керування клієнтами з використанням фреймворку Laravel</b><br><br>

Головні рекомендації щодо програмного забезпечення:<br>
PHP 8.3.6<br>
Composer 2.8.2<br>
Laravel 11<br>
MySQL 8.0.40<br>
redis-server 7.0.15<br>
php-redis<br>
повний перелік можна переглянути в yurchenko-anton-payalnya/doc/projectDependencies.txt<br><br>

Встановлення:<br>
1.Завантажити проект командою у git:<br>
git clone https://github.com/satnetuser001/yurchenko-anton-payalnya.git<br>
1а.Або скачати архив та розпакувати його:<br>
https://github.com/satnetuser001/yurchenko-anton-payalnya/archive/refs/heads/main.zip<br>
2.Встановити PHP пакети, виконати команду в терміналі у папці проекту yurchenko-anton-payalnya:<br>
composer install<br>
3.У MySQL створити базу даних та користувача:<br>
mysql -uroot -p<br>
CREATE DATABASE payalnya<br>
CHARACTER SET utf8<br>
COLLATE utf8_general_ci;<br>
CREATE USER 'payalnya_app'@'localhost' IDENTIFIED BY '1077';<br>
GRANT ALL PRIVILEGES ON payalnya.* TO 'payalnya_app'@'localhost';<br>
exit<br>
4.Накотити backup, команду виконати в терміналі у папці yurchenko-anton-payalnya/doc/mysqlDumpDB:<br>
mysql -uroot -p payalnya < payalnya.sql<br><br>

Запуск<br>
Відкрити два термінали у папці yurchenko-anton-payalnya, виконати команди і не закривати термінали:<br>
у першому:<br>
php artisan serve<br>
у другому:<br>
php artisan queue:work<br><br>

Відкрити у браузері:<br>
http://127.0.0.1:8000/<br><br>

Покрокове створення проекту описано у файлі yurchenko-anton-payalnya/doc/developmentLog.txt