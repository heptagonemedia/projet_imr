FROM debian:stretch

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -yq --no-install-recommends \
	apt-utils \
	# httpd install
	apache2 \
	libapache2-mod-php \
	# php install
	php \
	php-mysql \
	php-pgsql \
	&& apt-get clean && rm -rf /var/lib/apt/lists/*


COPY ./php.ini /etc/php/7.0/cli/php.ini

EXPOSE 80 443

WORKDIR /var/www/html

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD curl -f http://localhost || exit 1

CMD apachectl -D FOREGROUND 








