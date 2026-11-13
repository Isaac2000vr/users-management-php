FROM php:8.3-apache

# Extension para conectarse a MySQL / TiDB
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite headers

# Configuracion de Apache (DocumentRoot = raiz del proyecto, igual que en local)
COPY docker/apache-app.conf /etc/apache2/sites-available/000-default.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html
COPY . /var/www/html

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html

ENV PORT=80
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
