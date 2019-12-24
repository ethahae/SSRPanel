FROM php:apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN apt-get update && apt-get install -y --no-install-recommends libzip-dev libpng-dev cron && \
docker-php-ext-install gd bcmath zip pdo pdo_mysql && apt-get clean && \
rm -rf /var/lib/apt/lists && \
curl -fsSL https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && \
sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load && \
mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www/html
RUN touch /var/log/cron.log && \
cp .env.example .env && \
crontab /var/www/html/docker/cronfile && \
composer install && \
composer dumpautoload && \
php artisan key:generate && \
php artisan view:clear  && \
php artisan cache:clear && \
chown -R www-data:www-data /var/www/html
CMD ["/var/www/html/docker/start_server.sh"]
