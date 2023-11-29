// this file create the serve of our J.S to run on 

const http = require('http');// provides functionality for creating a server
const app = require('./API/app');

const port = process.env.PORT || 3000;

const server  = http.createServer(app);

server.listen(port);