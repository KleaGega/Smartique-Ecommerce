# Dockerfile
FROM php:8.2-apache

# Install  PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Set permissions (optional based on your setup)
RUN chown -R www-data:www-data /var/www/html
