## **Riverstart**
### Тестовое задание: Сборка проекта
Для сборки проекта используется **Laravel Sail**. Этапы сборки:
1. Склонировать этот репозиторий.
2. В корне проекта выполнить `composer install`.
3. Скопировать файл окружения: `cp .env.example .env`.
4. Сгенерировать ключ приложения: `php artisan key:generate`.
5. Установить пароль для пользователя `root` базы данных в `.env` - поле `DB_PASSWORD`.
6. Запустить проект командой `./vendor/bin/sail up` (при желании можно настроить алиас в `~/.bash_profile` для удобного использования команды). Проект станет доступен по адресу `http://0.0.0.0:80`. Перед запуском убедитесь, что порт `80` и порт `3306` не заняты другими процессами.
7. Выполнить миграцию в базу данных с заполнением тестовыми данными: `php artisan migrate --seed`.

### Стек
1. **PHP v. 8.1.3**
2. **MySQL v. 8.0.28**
3. **Laravel v. 9.18.0**
4. Также вместе с **Sail** поставляется несколько вспомогательных библиотек и технологий (`nodejs`/`npm`, `supervisor` etc.), но в проекте они не используются.

### Разработка
В рамках данного проекта подняты два контейнера: основной контейнер с приложением `riverstart-test` и контейнер базы данных `mysql`.
Команды `php artisan ...` следует выполнять из bash-консоли контейнера `riverstart-test` - команда `docker-compose exec riverstart-test bash`.
