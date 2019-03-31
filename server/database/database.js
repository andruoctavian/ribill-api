// getting-started.js
var mongoose = require('mongoose');
const dbName = 'test';

var db = mongoose.connection;

db.on('connecting',function(){
	console.log('Connecting');
});
db.on('connected',function(){
	console.log('Connected');
});
db.on('close',function(){
	console.log('Connection closed');
});
db.on('error',function(){
	console.log('Error while connecting:');
});
db.on('disconnected',function(){
	console.log('Database disconnected');
});

mongoose.connect('mongodb://localhost/' + dbName, { useNewUrlParser: true });

const services = require('./services.js');
const users = require('./users.js');
//const kitty = require('./kitty.js')
module.exports.service = services;
module.exports.user = users;
//module.exports.kitty = kitty;