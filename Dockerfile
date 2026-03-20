FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Create necessary directories
RUN mkdir -p /var/www/storage/logs && \
    mkdir -p /var/www/bootstrap/cache && \
    mkdir -p /var/www/storage/framework/sessions && \
    mkdir -p /var/www/storage/framework/cache && \
    mkdir -p /var/www/storage/framework/views && \
    chown -R www-data:www-data /var/www

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
