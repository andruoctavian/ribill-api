const express = require('express');
const app = express();
const multer = require('multer');
const upload = multer();

app.use(upload.array()); 
app.use(express.static('public'));


const service = require('./routes/service.js')



app.use('/service', service);

app.listen(9000);