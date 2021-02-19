const express = require('express');


const app = express(); //initializes the express application
const port = 8080; //Sets the Port the express server runs on

//on a request coming in...
//if they request / (aka the homepage)
app.get('/', (req, res) => {
   res.sendFile('./button.html', { root: __dirname }); // send them button.html
});
app.listen(port, () => console.log(`listening on port ${port}!`));