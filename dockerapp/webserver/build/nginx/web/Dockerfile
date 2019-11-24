FROM debian:stretch

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install -yq --no-install-recommends \
	apt-utils \
    vim \
    nginx
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# add the site
COPY ./resource/default-site /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]

