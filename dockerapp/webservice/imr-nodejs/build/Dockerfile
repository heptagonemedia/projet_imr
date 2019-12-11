FROM node:12.3.0

RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

RUN git clone --single-branch --branch calculateur-master  https://github.com/heptagonemedia/projet_imr.git \
    && cd projet_imr/calculateur \
    && npm install \
    && npm start
 
EXPOSE 3000
CMD ["npm", "start"]