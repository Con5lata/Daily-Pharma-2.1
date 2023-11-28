const http = require('http');// provides functionality for creating a server
const app = require('/app');
const port = process.env.PORT || 3000;

const SERVER = http.createServer(app);

server.listen(port);