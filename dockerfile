# Gunakan base image PHP dengan Apache
FROM php:7.4-apache

# Install dependensi yang dibutuhkan oleh Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli mbstring zip exif pcntl bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Salin konfigurasi Apache virtual host
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Salin seluruh kode proyek ke dalam container
COPY . .

# Install dependencies menggunakan Composer
RUN composer install

# Atur permission untuk storage dan cache Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Command untuk menjalankan Apache saat container dijalankan
CMD ["apache2-foreground"]
