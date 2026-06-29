FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mysqli zip \
    && a2enmod rewrite headers proxy proxy_http proxy_wstunnel \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress || true

COPY . .
COPY deploy/apache.conf /etc/apache2/sites-available/000-default.conf
COPY deploy/entrypoint.sh /usr/local/bin/glchat-entrypoint

RUN chmod +x /usr/local/bin/glchat-entrypoint \
    && mkdir -p storage/uploads public/uploads \
    && chown -R www-data:www-data storage public/uploads

EXPOSE 80

ENTRYPOINT ["glchat-entrypoint"]
CMD ["apache2-foreground"]
