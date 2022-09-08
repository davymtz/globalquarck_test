FROM php:8-fpm
# Set working directory
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
# Install dependencias y extensiones
RUN apt-get update \
&& apt-get install -yqq \
build-essential zip unzip vim curl \
libpng-dev libjpeg62-turbo-dev libzip-dev libfreetype6-dev libxml2-dev libxslt-dev \
locales jpegoptim optipng pngquant gifsicle \
libonig-dev libpq-dev libcurl4-openssl-dev pkg-config libssl-dev \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-install pdo pdo_mysql mysqli mbstring exif pcntl soap sockets xsl
# Install and config xdebug
RUN yes | pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& { \
echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)"; \
echo "xdebug.mode=develop,debug,coverage"; \
echo "xdebug.remote_autostart=off"; \
} > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
#Copy existing application directory contents and shell scripts
COPY ./backend .
#Se instalan los proyectos con composer
# Copy existing application directory permissions
COPY --chown=www:www ./backend .
# Change current user to www
USER www
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
