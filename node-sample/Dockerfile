FROM node:lts-alpine

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . /app

EXPOSE 43000

CMD [ "npm", "start" ]
