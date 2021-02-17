
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
const mysql = require('mysql');

var realurl = "string";

console.log(realurl)
const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  
  //window.location.href = realurl;

  res.end('Hello World This did not redirect' + realurl);
  res.redirect('/html');
  });


const port = process.env.port || 8080;
server.listen(port, () => {
    console.log("Sever console log.")
});



const con = mysql.createConnection({
    host: "csci2999b02.cps316w6axpe.us-east-1.rds.amazonaws.com,1433",
    user: "orangeteam",
    password: "capstone02"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    con.end();
});
