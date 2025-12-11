FROM dunglas/frankenphp:alpine

RUN install-php-extensions \
    pdo_sqlite \
    sqlite3 \
    opcache \
    xdebug \
    intl

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
