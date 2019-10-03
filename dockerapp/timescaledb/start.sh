#!/bin/bash
docker-compose stop && docker-compose rm -f
FILE=./build/Dockerfile
if [ -f $FILE ]; then
  rm $FILE
fi
cat > $FILE <<EOL
FROM timescale/timescaledb:latest-pg10
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow
RUN usermod -u ${UID:-0} postgres
EOL
docker-compose up -d --build