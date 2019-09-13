cd docker-compose/letsencrypt/
docker-compose up -d
cd ../pgadmin/
docker-compose up -d
cd ../portainer/
docker-compose up -d
cd ../postgres/
docker-compose up -d
cd ../webserver/
docker-compose up -d

