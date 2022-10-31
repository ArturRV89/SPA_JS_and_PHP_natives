FROM phpdockerio/php:8.0-fpm
WORKDIR "/public"
RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.0-mysql; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
CMD docker exec -i spa_db mysql -u root -p123123 < dump/dump-spa-database.sql;
