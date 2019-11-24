FROM debian:stretch

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install -yq --no-install-recommends \
	apt-utils \
    vim \
    php7.0 \
    php7.0-fpm \
    php7.0-cli \
    php7.0-curl \
    php7.0-mysql \
    php7.0-curl \
    php7.0-gd \
    php7.0-mbstring \
    php-pear \
    nginx
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# add php.ini
# RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.0/fpm/php.ini
# RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.0/cli/php.ini

CMD ["php", "-a"]

EXPOSE 9000
