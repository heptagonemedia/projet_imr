# Documentation administration système

Pour les besoins du projet, l'installation a été effectuée sur un serveur privé virtuel.

## Serveur

| choix technologiques   |                         |
| ---------------------- | ----------------------- |
| fournisseur            | ovh france              |
| système d'exploitation | ubuntu server 18.04 LTS |
| paquets installés      | docker docker-compose   |

### Installation

#### Reverse-proxy

Reverse proxy nginx de l'image docker linuxserver/letsencrypt équipé de:

* **fail2ban** (protection DDOS)
* **certbot letsencrypt** (génération et renouvellement automatique de certificats SSL)

##### docker-compose

```yaml
version: '2'
services:
  letsencrypt:
    image: linuxserver/letsencrypt
    container_name: letsencrypt
    cap_add:
      - NET_ADMIN
    environment:
      - PUID=1000
      - PGID=1000
      - TZ=Europe/Paris
      - URL=vpsloic.loicbertrand.net
      - SUBDOMAINS=webmin,portainer,pgadmin,imr-app,
      - VALIDATION=http
      - DHLEVEL=2048 #optional
      - ONLY_SUBDOMAINS=true #optional
      - STAGING=true #optional
    volumes:
      - ./config:/config
    network_mode: host
    ports:
      - 443:443
      - 80:80
    restart: always
```

##### proxy-confs

###### glances

```nginx
# make sure that your dns has a cname set for glances and that your glances container is not using a base url

server {
    listen 443 ssl;
    listen [::]:443 ssl;

    server_name glances.*;

    include /config/nginx/ssl.conf;

    client_max_body_size 0;

    # enable for ldap auth, fill in ldap details in ldap.conf
    #include /config/nginx/ldap.conf;

    location / {
        # enable the next two lines for http auth
        #auth_basic "Restricted";
        #auth_basic_user_file /config/nginx/.htpasswd;

        # enable the next two lines for ldap auth
        #auth_request /auth;
        #error_page 401 =200 /login;

        include /config/nginx/proxy.conf;
        resolver 127.0.0.11 valid=30s;
        set $upstream_glances glances;
        proxy_pass http://$upstream_glances:61208;
    }
}

```

###### imr

```nginx
server {
    listen 443 ssl;
    listen [::]:443 ssl;

    server_name imr-app.vpsloic.*;

    include /config/nginx/ssl.conf;

    client_max_body_size 0;

    location / {
        include /config/nginx/proxy.conf;
        resolver 127.0.0.11 valid=30s;
        proxy_pass http://localhost:4343;
		
        proxy_set_header Range $http_range;
        proxy_set_header If-Range $http_if_range;
    }
	
    location ~ (/imr)?/socket {
        include /config/nginx/proxy.conf;
        resolver 127.0.0.11 valid=30s;
        proxy_pass http://localhost:4343;
		
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection $http_connection;
   }
}
```

###### pgadmin

```nginx
# make sure that your dns has a cname set for pgadmin

server {
    listen 443 ssl;
    listen [::]:443 ssl;

    server_name pgadmin.*;

    include /config/nginx/ssl.conf;

    client_max_body_size 0;

    location / {

        resolver 127.0.0.11 valid=30s;
        set $upstream_pgadmin pgadmin;
        proxy_pass http://localhost:8010;
        proxy_set_header Connection "";
        proxy_http_version 1.1;
        proxy_hide_header X-Frame-Options;
    }

    location /api/websocket/ {

        resolver 127.0.0.11 valid=30s;
        set $upstream_pgadmin pgadmin;
        proxy_pass http://localhost:8010;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_http_version 1.1;
        proxy_hide_header X-Frame-Options;
    }
}
```

#### Pgadmin

Pgadmin, outil d'administration de base de données PostgresSQL, dans un conteneur docker.

##### docker-compose

```yaml
version: '3'
services:
  pgadmin:
    image: dpage/pgadmin4
    container_name: pgadmin
    ports:
      - 8010:80
    environment:
      PGADMIN_DEFAULT_EMAIL: admin@admin.com
      PGADMIN_DEFAULT_PASSWORD: password
    volumes:
      - ./data:/root/.pgadmin
    restart: always
    networks:
      - default
      - postgres

networks:
  default:
  postgres:
    external:
      name: postgres_default
```

#### timescaledb

Timescaldb, serveur de bases de données.

##### docker-compose

```yaml
version: '3.2'
services:
  postgres:
    container_name: postgres
    image: timescale/timescaledb:latest-pg10
    command: postgres -c port=2232
    environment:
      - USER_ID=1000
      - GROUP_ID=1000
      - PGDATA=data/postgresql
      - POSTGRES_USER=admin
      - POSTGRES_PASSWORD=password
      - POSTGRES_DB=postgre
    volumes:
      - ./data:/data/postgresql
    ports:
      - 2232:2232
    restart: always
```

#### webserver nginx+php-fpm

Webserver composé de nginx et de php-fpm.

##### docker-compose

```yaml
version: '3'
services:
  php-fpm:
    container_name: php-fm
    build:
      context: ./build/php-fpm
    volumes:
      - ./webroot:/var/www/html:ro

  nginx:
    container_name: nginx
    build: 
      context: ./build/nginx
    volumes:
      - ./webroot:/var/www/html:ro
      - ./conf/nginx/nginx.conf:/etc/nginx/nginx.conf
      - ./conf/nginx/sites/:/etc/nginx/sites-available
      - ./conf/nginx/conf.d/:/etc/nginx/conf.d
    ports:
      - 4343:80
    depends_on:
      - php-fpm
    restart: always
```

### Configuration

#### Remote git

La remote git configuré avec un hook post-receive permet de déployer les mises à jour du site web en une seule ligne de commande.

##### Mise en place

* initialiser un repository en tant que remote

```shell
git bare init --bare ./$REPOSITORY_NAME.git
```

* naviguer jusqu'au dossier **hooks**

```shell
cd hooks
```

* Créer un fichier **post-receive**

```shell
vim post-receive
```

```shell
#!/bin/bash
TARGET="/home/webuser/deploy-folder"
GIT_DIR="/home/webuser/www.git"
BRANCH="master"

while read oldrev newrev ref
do
	# only checking out the master (or whatever branch you would like to deploy)
	if [ "$ref" = "refs/heads/$BRANCH" ];
	then
		echo "Ref $ref received. Deploying ${BRANCH} branch to production..."
		git --work-tree=$TARGET --git-dir=$GIT_DIR checkout -f $BRANCH
	else
		echo "Ref $ref received. Doing nothing: only the ${BRANCH} branch may be deployed on this server."
	fi
done
```

* Donner les droits d'execution

```shell
chmod +x post-receive
```

* Ajouter la remote sur le votre **client** git

```shell
git remote add live ssh://$USER@$HOST:$PORT/$ABSOLUTE_PATH_TO_REPOSITORY/$REPOSITORY_NAME.git
```