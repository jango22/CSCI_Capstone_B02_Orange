
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

var Connection = require('tedious').Connection;  
    var config = {  
        server: 'capstoneclass-env-1.eba-waeucf93.us-east-1.elasticbeanstalk.com',  
        authentication: {
            type: 'default',
            options: {
                userName: 'orangeteam', 
                password: 'capstone02'  
            }
        },
        options: {
            // If you are on Microsoft Azure, you need encryption:
            encrypt: true,
            database: 'csci2999b02'  
        }
    };  
    var connection = new Connection(config);  
    connection.on('connect', function(err) {  
        // If no error, then good to proceed.
        console.log("Connected");  
    });
    
    connection.connect();
