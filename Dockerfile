FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libicu-dev libzip-dev \
    libgd-dev libexif-dev libxml2-dev \
    && docker-php-ext-install \
    intl zip gd exif pdo pdo_mysql \
    opcache mbstring xml ctype fileinfo \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-dev --no-interaction --ignore-platform-reqs

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080