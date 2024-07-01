#!/usr/bin/env bash

set -e
# apply environment variables to default.conf
envsubst '$HOME_DOMAIN, $HOME_PORT' < /etc/nginx/conf.d/app.conf.template > /etc/nginx/conf.d/default.conf
# Start supervisord and services (run php-fpm & nginx)
exec /usr/bin/supervisord -n -c /etc/supervisord.conf
