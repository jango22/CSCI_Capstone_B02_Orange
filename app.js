
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

const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Hello World');
});

const port = process.env.port || 8080;
server.listen(port, () => {
    console.log("Sever console log.")
});

<html>
<body>

<p>Click the button labeled "Log Time" to store the time you pressed the button.</p>

<button onclick="LodCurrentTime()">Log Time</button>
<p>Time the button was clicked last:</p>
<p id="lblTime">Never</p>

<script>
    function LogCurrentTime() {
        var date = new Date();
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds;
        document.getElementById("lblTime").innerHTML = time;

    };
</script>

</body>
</html
