#!/bin/bash
cd /tmp/erp
echo "Configuring service"
case $APPLICATION_NAME in
      *"dev"*)
      export homepath=/var/www/html/erp/bh-dev
      export configfile=etc/configs/env.dev
      ;;
      *"prod"*|*"prd"*)
      export homepath=/var/www/html/erp/bh-prd
      export configfile=etc/configs/env.prd
      ;;
      *"stg"*|*"stg"*)
      export homepath=/var/www/html/erp/bh-stg
      export configfile=etc/configs/env.stg
      ;;
      *)
      echo "Cannot file environment configuration"
esac
rsync -arv ./ $homepath/
# # Sync files from source to destination and delete extraneous files from destination
# rsync -arv --delete ./ $homepath/
chown ec2-user.ec2-user  /var/www/html/erp -R
# Give needful permissions to NICE API executables
sudo chmod 775 -R "${homepath}/Modules/Core/Resources/libs/nice-phone-verify/CPClient_linux_x64"

configure_application(){
      echo $homepath
      echo $configfile
      cd $homepath
      # mv $configfile .env

      # Move the application into maintenance mode
      php artisan down --refresh=10 --render="maintainace"

      #composer update
      composer install --no-dev
      #composer require anlutro/l4-settings:^1.1
      #composer require arrilot/laravel-widgets:^3.13
      #composer require devsrv/livewire-modal:^1.1
      #composer require fideloper/proxy:^4.2
      #composer require guzzlehttp/guzzle:^7.0.1
      #composer require jantinnerezo/livewire-alert:^2.2
      #composer require jeroennoten/laravel-adminlte:^3.8
      #composer require kalnoy/nestedset:^6.0
      #composer require kris/laravel-form-builder:^1.50
      #composer require laravel/ui:^3.4
      #composer require livewire/livewire:^2.10
      #composer require mhmiton/laravel-modules-livewire:^1.5
      #composer require nwidart/laravel-modules:^8.3
      #composer require plank/laravel-mediable:5.9
      #composer require santigarcor/laratrust:^7.0
      #composer require maatwebsite/excel:^3.1
      #composer require simplesoftwareio/simple-qrcode:4.2
      #composer require elibyy/tcpdf-laravel:^9.0
      #composer require akaunting/laravel-setting:1.2
      #composer require yajra/laravel-datatables:1.5
      #composer require yajra/laravel-datatables-html:4.10
      #composer require yajra/laravel-datatables-editor:1.22
      #composer require jenssegers/agent:^2.6
      #composer require mashape/unirest-php:^3.0
      #composer require kalnoy/nestedset:^6.0
      #composer require shipu/themevel:^3.0

      rm -rf public/storage
      rm -rf public/Themes
      php artisan key:generate
      php artisan migrate
      php artisan config:clear
      php artisan cache:clear
      php artisan view:clear
      php artisan optimize:clear
      php artisan config:cache
      php artisan optimize
      php artisan storage:link
      composer dump-autoload
      php artisan route:clear
      #generate passport keys if not exist
      php artisan passport:keys

    # Make application live
      php artisan up
}
export -f configure_application
su ec2-user -c "configure_application"

# Clean up
[[ $? == 0 ]] && rm -rf /tmp/erp
