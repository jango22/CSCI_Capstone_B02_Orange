
/*
const express = require('express');

// const app = express();

const port = 80;

app.get('/', (req, res) => {
    res.sendFile('./www/index.html', { root: __dirname });
});

app.listen(port, () => console.log(`listening on port ${port}!`));

*/


const http = require('http');
const express = require('express');
const app = express();

var realurl = "string";

console.log(realurl)

const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  
  //window.location.href = realurl;

  res.end('Hello World');
  //res.redirect('/html');

  });
//THIS IS A CHANGE


const port = process.env.port || 8080;
server.listen(port, () => {
    console.log("Sever console log.")
});

