# Base image
FROM php:7.4-apache

# Install required PHP extensions and tools
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Copy PHP files
COPY ./www /var/www/html

# Set the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Enable mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Expose ports
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
