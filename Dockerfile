# ----------------------------------------------------------
# STAGE 1: Base PHP + extensions
# ----------------------------------------------------------
FROM php:8.4-fpm AS base

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip gd opcache

RUN docker-php-ext-install pdo_mysql mbstring zip

WORKDIR /var/www/html

# ----------------------------------------------------------
# STAGE 2: Composer
# ----------------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /var/www/html

COPY .. /var/www/html
RUN composer install --no-dev --prefer-dist --optimize-autoloader


# ----------------------------------------------------------
# STAGE 3: Final Production Image
# ----------------------------------------------------------
FROM base AS production

WORKDIR /var/www/html

COPY --from=vendor /var/www/html /var/www/html


# Opcional: Opcache recomendado para prod
RUN docker-php-ext-enable opcache

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
