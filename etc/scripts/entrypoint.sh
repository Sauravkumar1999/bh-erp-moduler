#!/bin/bash
su appuser
# export homepath=/var/www/html/erp/bh-dev
for env in $(printenv); do
    if [[ $env == "AWS"* ]]; then
        echo "$env" >> .env
    fi;
done;

chown appuser.appuser  /var/www/html/laravel -R

chmod 775 -R "/var/www/html/laravel/Modules/Core/Resources/libs/nice-phone-verify/CPClient_linux_x64"

# composer install
composer update
composer dump-autoload
php artisan key:generate
# php artisan config:clear
# php artisan cache:clear
php artisan optimize:clear
php artisan migrate
# php artisan optimize
# php artisan config:cache
# npm install
# npm run development
php artisan serve --host 0.0.0.0
