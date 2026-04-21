FROM php:8.4-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git curl libzip-dev unzip zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP-FPM を起動
CMD ["php-fpm"]