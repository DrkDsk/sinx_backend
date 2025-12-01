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

ARG FOLDER_WEB=/var/www/html

WORKDIR "${FOLDER_WEB}"

# ----------------------------------------------------------
# STAGE 2: Composer
# ----------------------------------------------------------
FROM composer:2 AS vendor

ARG FOLDER_WEB=/var/www/html

WORKDIR "${FOLDER_WEB}"

COPY .. "${FOLDER_WEB}"

RUN composer install --no-dev --prefer-dist --optimize-autoloader


# ----------------------------------------------------------
# STAGE 3: Final Production Image
# ----------------------------------------------------------
FROM base AS production

WORKDIR "${FOLDER_WEB}"

COPY --from=vendor "${FOLDER_WEB}" "${FOLDER_WEB}"


# Opcional: Opcache recomendado para prod
RUN docker-php-ext-enable opcache

# Permissions
RUN sh -c "chown -R www-data:www-data $FOLDER_WEB/storage $FOLDER_WEB/bootstrap/cache"

EXPOSE 9000

CMD ["php-fpm"]
