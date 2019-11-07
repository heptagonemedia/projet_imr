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

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite && \
	service apache2 stop && \
	service apache2 start

EXPOSE 80 443

WORKDIR /var/www/html

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD curl -f http://localhost || exit 1

CMD apachectl -D FOREGROUND
