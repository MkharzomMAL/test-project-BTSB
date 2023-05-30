# Dockerfile
FROM php:5.6-apache

# Install MySQL extension for PHP
RUN docker-php-ext-install mysqli

# Copy PHP files
COPY . /var/www/html

EXPOSE 80
