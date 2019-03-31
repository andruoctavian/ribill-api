const express = require('express');
const app = express();
const multer = require('multer');
const upload = multer();

app.use(upload.array()); 
app.use(express.static('public'));

app.use(function (req, res, next) {
    res.set('Access-Control-Allow-Origin', '*');
    res.set('Access-Control-Allow-Headers', '*');
    next();
  });

const service = require('./routes/service.js')

app.use('/service', service);

app.listen(9000);