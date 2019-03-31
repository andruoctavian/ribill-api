const express = require('express');
const app = express.Router();
const db = require('../database/database.js');


app.get('/list', async function(req, res){
    let serviceId = req.query.serviceId;
    let metric = await db.service.listMetrics(serviceId);
    res.send(JSON.stringify(metric));
});

app.post('/add', async function(req, res){
    
    try{
        let s = await db.service.addMetric(req.body.name, req.body.serviceId, req.body.method, req.body.url);
        res.send(s);
    }
    catch(e){
        res.send(false);
    }
});


module.exports = app;