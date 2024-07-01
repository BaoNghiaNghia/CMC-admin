############################### BUILD BASE PHP-NGINX ##################################
FROM php:8.3.0-fpm-alpine3.19

LABEL maintainer="Trung Ha <trunghd@tanca.io>"
ENV NGINX_VERSION 1.19.1
ENV UID 2020
ENV USER tancak8s
ENV GID 2020
ENV GROUP tancak8s

# resolves #166
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php
RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/community gnu-libiconv

# Install Nginx
RUN apk add --no-cache nginx

# Create a directory for Nginx run files
RUN mkdir -p /run/nginx

RUN echo @testing http://nl.alpinelinux.org/alpine/edge/testing >> /etc/apk/repositories && \
    echo /etc/apk/respositories && \
    apk update --allow-untrusted  && apk upgrade
RUN apk add --no-cache \
    bash\
    openssh-client \
    wget \
    supervisor \
    curl \
    zip \
    unzip \
    libcurl \
    imap-dev \
    openssl \
    openssl-dev \
    git \
    python3 \
    python3-dev \
    py3-pip \
    augeas-dev \
    ca-certificates \
    dialog \
    autoconf \
    make \
    gcc \
    musl-dev \
    linux-headers \
    libmcrypt-dev \
    libpng-dev \
    icu-dev \
    libpq \
    libxslt-dev \
    libffi-dev \
    freetype-dev \
    sqlite-dev \
    libjpeg-turbo-dev \
    postgresql-dev \
    libzip-dev \
    bzip2-dev && \
    docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ && \
    docker-php-ext-install pdo_mysql pdo_sqlite pgsql pdo_pgsql mysqli gd exif intl xsl opcache pcntl bcmath sockets && \
    pecl install -o -f redis && \
    echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini && \
    #TODO TRUNGHA: INSTALL MONGODB DRIVER
    pecl install -o -f mongodb && \
    echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini && \
    docker-php-source delete && \
    mkdir -p /etc/nginx && \
    mkdir -p /run/nginx && \
    mkdir -p /var/log/supervisor && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --quiet --install-dir=/usr/bin --filename=composer && \
    rm composer-setup.php && \
    apk del gcc musl-dev linux-headers libffi-dev augeas-dev python3-dev make autoconf
# RUN apk add --no-cache libzip-dev
# RUN apk add --no-cache bzip2-dev

# Add supervisord
ADD docker/base_conf/supervisord.conf /etc/supervisord.conf

# Copy our nginx config
ADD docker/base_conf/nginx.conf /etc/nginx/nginx.conf

# Copy www.conf
ADD docker/base_conf/www.conf /usr/local/etc/php-fpm.d/www.conf

# Add php config file

ADD docker/base_conf/docker-vars.ini docker/base_conf/opcache.ini /usr/local/etc/php/conf.d/

############################### END BUILD BASE PHP-NGINX ##################################

# Copy entrypoint to container
COPY docker/entrypoint.sh /tmp/
COPY docker/app.conf.template /etc/nginx/conf.d/

# set excute permision
RUN chmod 755 /tmp/entrypoint.sh && \
    chmod +x /tmp/entrypoint.sh

# Set workdir application
WORKDIR /var/www/home

# Group add
RUN addgroup -g $GID -S $USER
RUN adduser -D -S -h /var/www/home -s /bin/bash -G $GROUP -u $UID $USER

# Copy file into container
COPY --chown=$USER:$GROUP . .

RUN apk add --no-cache gettext

#Unzip folder vendor-release
RUN chmod 755 /tmp/entrypoint.sh && \
    chmod +x /tmp/entrypoint.sh &&\
    # move vendor & unzip
    mv docker/vendor-release.zip . && \
	  unzip vendor-release.zip && \
	  mv vendor-release vendor && \
    rm -rf public/files && \
    # remove file
	  rm -rf docker && \
	  rm -rf Dockerfile && \
	  rm -rf vendor-release.zip && \
    rm -rf .env && \
    # make folder storage
    mkdir -p storage/app && \
    mkdir -p storage/framework/cache && \
    mkdir -p storage/framework/sessions && \
    mkdir -p storage/framework/views && \
    mkdir -p storage/logs && \
    chmod -R 755 storage && \
    chown -R $USER:$GROUP storage && \
    chown -R $USER:$GROUP /var/lib/nginx

EXPOSE 443 80

# Run check queue
CMD ["/tmp/entrypoint.sh"]