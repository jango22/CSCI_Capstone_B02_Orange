
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

  res.end('Hello World This did not redirect' + realurl);
  res.redirect('/html');
  });


const port = process.env.port || 8080;
server.listen(port, () => {
    console.log("Sever console log.")
});

var Connection = require('node.js').Connection;  
    var config = {  
        server: 'aa96jyhrersobx.cps316w6axpe.us-east-1.rds.amazonaws.com,1433',  //update me
        authentication: {
            type: 'default',
            options: {
                userName: 'orangeteam', //update me
                password: 'capstone02'  //update me
            }
        },
        options: {
            // If you are on Microsoft Azure, you need encryption:
            encrypt: true,
            database: 'CSCI299B02'  //update me
        }
    };  
    var connection = new Connection(config);  
    connection.on('connect', function(err) {  
        // If no error, then good to proceed.
        console.log("Connected");  
    });
    
    connection.connect();

