#!/bin/bash
docker-compose stop && docker-compose rm -f
FILE=./build/Dockerfile
if [ -f $FILE ]; then
  rm $FILE
fi
cat > $FILE <<EOL
FROM postgres:10.10

RUN usermod -u ${UID:-0} postgres
EOL
docker-compose up -d --build