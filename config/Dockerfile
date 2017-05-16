FROM php:7.1-apache

# Install dependency packages
RUN apt-get update && apt-get install -y \
		git \
		curl \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev 

# Install iconv for PHP
RUN docker-php-ext-install -j$(nproc) iconv

# Install mcrypt for PHP
RUN docker-php-ext-install -j$(nproc) mcrypt

# Install GD
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install PDO driver for PHP
RUN docker-php-ext-install pdo pdo_mysql

# Enable module rewrite of Apache2
RUN a2enmod rewrite

# Add user www-data to /var/www
RUN chown -R www-data:www-data /var/www
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# Add virtualhost
ADD ./laravel.dev.conf /etc/apache2/sites-available/laravel.dev.conf
RUN a2ensite laravel.dev.conf 

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose 80
EXPOSE 80