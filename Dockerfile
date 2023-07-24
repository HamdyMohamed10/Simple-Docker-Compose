# Base image
FROM php:7.4-apache

# Install necessary extensions and packages
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libpq-dev \
        libzip-dev \
        unzip \
        git \
        curl && \
    docker-php-ext-install gd pdo pdo_mysql mysqli  zip && \
    a2enmod rewrite 

# Copy application code to container
COPY ./app /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80
