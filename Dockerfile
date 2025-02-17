# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Install system dependencies
# These are needed for PHP extensions and general functionality
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear apt cache to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions for CodeIgniter
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Enable Apache rewrite module for URL rewriting
RUN a2enmod rewrite

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in container
WORKDIR /var/www/html

# Copy project files to container
COPY . /var/www/html/

# Set proper permissions:
# - www-data is Apache's user
# - 755 allows read/execute for everyone, write for owner
# - writable directory needs 777 for CodeIgniter to write logs, cache, etc.
RUN chown -R www-data:www-data /var/www/html \    # Change owner to Apache user
    && find /var/www/html -type f -exec chmod 644 {} \; \    # Files get 644
    && find /var/www/html -type d -exec chmod 755 {} \; \    # Directories get 755
    && chmod -R 777 /var/www/html/writable         # Writable directory gets full permissions

# Create and enable Apache configuration for CodeIgniter
# This ensures proper handling of .htaccess and directory access
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/codeigniter.conf \
    && a2enconf codeigniter

# Update Apache's default site to point to CodeIgniter's public directory
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
