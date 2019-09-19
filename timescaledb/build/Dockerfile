FROM timescale/timescaledb:latest-pg10
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow
RUN usermod -u 1000 postgres
