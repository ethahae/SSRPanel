FROM php:apache
RUN apt-get update && apt-get install -y libzip-dev libpng-dev && docker-php-ext-install gd bcmath zip pdo pdo_mysql && apt-get clean
RUN curl -fsSL https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY . /var/www/html
RUN composer install
RUN composer dumpautoload && php artisan key:generate && php artisan view:clear  && php artisan cache:clear
