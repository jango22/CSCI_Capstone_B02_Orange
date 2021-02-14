
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


const server = http.createServer((req, res) => {
  res.statusCode = 301;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Hello World This did not redirect' + window.location.href);

  res.redirect('/html')
  });

const port = process.env.port || 8080;
server.listen(port, () => {
    console.log("Sever console log.")
});


