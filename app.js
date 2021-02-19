const http = require('http');
const express = require('express');
const app = express();

var realurl = "string";

console.log(realurl)

const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');

  res.end('Hello World');
  //res.redirect('/html');

});


const port = process.env.port || 8090;
server.listen(port, () => {
    console.log("Sever console log.")
});

