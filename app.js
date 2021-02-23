const e = require('express');
const express = require('express');


const app = express(); //initializes the express application
const port = 8080; //Sets the Port the express server runs on
app.set('view engine', 'pug');
app.set('views', './views')

function sqlconnect (){
 // config for your database
 var sql = require('mssql');
 var config = {
  user: 'orangeteamadmin',
  password: 'capstone02',
  server: 'csci2999b02.cps316w6axpe.us-east-1.rds.amazonaws.com',
  //database: 'csci2999b02'
  };

  // connect to your database
  sql.connect(config, function (err) {

    if (err) console.log(err);
    return 'help me';
    
  });


};
//on a request coming in...
//if they request / (aka the homepage)
app.get('/', (req, res) => {
   res.sendFile('./templates/button.html', { root: __dirname }); // send them button.html
});


app.get('/dbtest', (req, res) => {
  var sqlstat = sqlconnect();
  console.log(sqlstat);
  res.render('index', { title: 'This Works?', message: sqlstat })
});



app.listen(port, () => console.log(`listening on port ${port}!`));
//help
