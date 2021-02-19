var sql = require('mssql');

var config = {


}
var express = require('express');
var app = express();
   
var sql = require('mssql');
// config for your database
var config = {
        user: "orangeteamadmin",
        password: 'capstone02',
        server: 'csci2999b02.cps316w6axpe.us-east-1.rds.amazonaws.com',
        //port: 1433

    };
    // connect to your database
    
sql.connect(config, function (err) {
    
    if (err) console.log(err);

        // create Request object
    var request = new sql.Request();
    
        // query to the database and get the records
        request.query('select * from Student', function (err, recordset) {
            
            if (err) console.log(err)

            // send records as a response
            res.send(recordset);
            
        });
    
    });
    

var server = app.listen(5000, function () {
    console.log('Server is running..');
});
