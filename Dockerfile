FROM php:7.3-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip 
RUN apt-get update \
	&& apt-get install -y gnupg gnupg2 gnupg1 \
	&& curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
	&& curl https://packages.microsoft.com/config/ubuntu/16.04/prod.list > /etc/apt/sources.list.d/mssql-release.list \
	&& exit \
	&& apt-get update \
	&& ACCEPT_EULA=Y apt-get install msodbcsql mssql-tools \
	&& apt-get install -y unixodbc-dev \
RUN docker-php-source extract \
	&& mkdir -p /usr/src/php/ \
	&& pecl channel-update pecl.php.net \
    && pecl install sqlsrv \ 
    && pecl install pdo_sqlsrv \
    && echo extension=pdo_sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/pdo_sqlsrv.ini \
    && echo extension=sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/sqlsrv.ini \
    && curl https://packages.microsoft.com/config/rhel/7/prod.repo > /etc/yum.repos.d/mssql-release.repo \
	
RUN curl https://packages.microsoft.com/config/ubuntu/20.10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
	&& exit \
	&& sudo apt-get update \
	&& sudo ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
	# optional: for bcp and sqlcmd
	&& sudo ACCEPT_EULA=Y apt-get install -y mssql-tools \	
	&& echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc \
	&& source ~/.bashrc \
	# optional: for unixODBC development headers
	&& sudo apt-get install -y unixodbc-dev \

RUN apt-get update \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y install unixodbc-dev msodbcsql17

RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
	&& curl https://packages.microsoft.com/config/ubuntu/20.10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
	&& apt-get update \
	&& ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
	&& apt-get install -y unixodbc-dev  \
	&& docker-php-ext-install mbstring pdo pdo_mysql exif pcntl bcmath gd \
    && pecl install sqlsrv pdo_sqlsrv xdebug \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions


# Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user